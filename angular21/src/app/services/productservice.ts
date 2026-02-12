import { Injectable, inject } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import {  Observable } from 'rxjs';

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
    return this.http.get('http://localhost:5270/products/report', { 
      responseType: 'blob' 
    });
  }

  public showSalesGraph(): Observable<Blob> {
    return this.http.get("http://localhost:5270/sales/chart", { responseType: 'blob' });
  }
  


}
