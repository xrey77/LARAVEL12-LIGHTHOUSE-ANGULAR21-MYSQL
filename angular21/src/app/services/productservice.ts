import { Injectable, inject } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import {  map, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class Productservice {
  private apiUrl = "http://127.0.0.1:8000/graphql";
  private http = inject(HttpClient);

  public sendSearchRequest(page: number, keyword: any): Observable<any>
  {
    const SEARCH_QUERY = `
      query ProductsSearch($keyword: String, $first: Int, $page: Int) {
          productsSearch(keyword: $keyword, first: $first, page: $page) {
            data {
                id
                category
                descriptions
                qty
                unit
                sellprice
                productpicture
            }
            paginatorInfo {
                currentPage
                lastPage
                total
                hasMorePages
            }
          }
      }
    `
      return this.http.post(this.apiUrl, {
      query: SEARCH_QUERY,
      variables: { 
          "page": page,
          "keyword": keyword
       }
    });

  }

  public sendProductRequest(page: number): Observable<any>
  {
    const LIST_QUERY = `
      query ProductsList($page: Int!) {
          productsList(first: 5, page: $page) {
            data {
                id
                category
                descriptions
                qty
                unit
                sellprice
                productpicture
            }
            paginatorInfo {
                currentPage
                lastPage
                total
                hasMorePages
            }
          }
      }
    `
      return this.http.post(this.apiUrl, {
      query: LIST_QUERY,
      variables: { 
          "page": page
       }
    });

  } 
  
public showPdfReport(): Observable<Blob> {
    const REPORT_QUERY = {
      query: `
        query ProductReport {
          productReport {
            filename        
            base64
          }
        }
      `
    };

    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    return this.http.post<any>(this.apiUrl, REPORT_QUERY, { headers }).pipe(
      map(res => {
        console.log(res);
        if (res.errors) {
          throw new Error(res.errors[0].message);
        }
        if (!res?.data?.productReport) {
          throw new Error('GraphQL response missing productReport data');
        }
        return res.data.productReport;
      }),
      map(data => {
        const byteCharacters = atob(data.base64);
        const byteNumbers = new Uint8Array(byteCharacters.length);
        for (let i = 0; i < byteCharacters.length; i++) {
          byteNumbers[i] = byteCharacters.charCodeAt(i);
        }
        return new Blob([byteNumbers], { type: 'application/pdf' });
      })
    );            
}

  public showSalesGraph(): Observable<Blob> {
    return this.http.get("http://localhost:5270/sales/chart", { responseType: 'blob' });
  }
  


}
