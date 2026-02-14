
export default {
  bootstrap: () => import('./main.server.mjs').then(m => m.default),
  inlineCriticalCss: true,
  baseHref: '/',
  locale: undefined,
  routes: [
  {
    "renderMode": 2,
    "route": "/"
  },
  {
    "renderMode": 2,
    "route": "/static"
  },
  {
    "renderMode": 2,
    "route": "/about"
  },
  {
    "renderMode": 2,
    "route": "/contact"
  },
  {
    "renderMode": 2,
    "route": "/profile"
  },
  {
    "renderMode": 2,
    "route": "/productlist"
  },
  {
    "renderMode": 2,
    "route": "/productcatalog"
  },
  {
    "renderMode": 2,
    "route": "/productsearch"
  },
  {
    "renderMode": 2,
    "route": "/productreport"
  },
  {
    "renderMode": 2,
    "route": "/saleschart"
  },
  {
    "renderMode": 2,
    "route": "/pdfreport"
  },
  {
    "renderMode": 2,
    "route": "/**"
  }
],
  entryPointToBrowserMapping: undefined,
  assets: {
    'index.csr.html': {size: 9845, hash: '025bbd7df2faefd25b0bbc8131a96222e02bc2dd1bad3620cac966e52170429a', text: () => import('./assets-chunks/index_csr_html.mjs').then(m => m.default)},
    'index.server.html': {size: 1161, hash: '98b509d2bf55109e69d3c15f75764e2674a3d50e58bc74530049b5e1fd558b76', text: () => import('./assets-chunks/index_server_html.mjs').then(m => m.default)},
    'static/index.html': {size: 42103, hash: 'ee9e1d89a165e0d7ed779cdc221650c1e71bfd45905a9a64af9ce486396df350', text: () => import('./assets-chunks/static_index_html.mjs').then(m => m.default)},
    'profile/index.html': {size: 61670, hash: '45013a6c1e8bc52668657fba6610976705c11f613ecea1e4a25822770182e357', text: () => import('./assets-chunks/profile_index_html.mjs').then(m => m.default)},
    'index.html': {size: 54104, hash: '5a94cc99d6c6c7874c591f0f9f0d6b75f3c5ad7e0d74455c72fdd9d0541fe3e6', text: () => import('./assets-chunks/index_html.mjs').then(m => m.default)},
    'productsearch/index.html': {size: 47416, hash: '4467ad0eac04d454241ef9a85f12e52ff58358674e15dbbffc62df981fbbb186', text: () => import('./assets-chunks/productsearch_index_html.mjs').then(m => m.default)},
    'saleschart/index.html': {size: 45285, hash: '1d1546a6ee058da4285b3c84a198984b007a85677864124b4ff55ba1ba05031d', text: () => import('./assets-chunks/saleschart_index_html.mjs').then(m => m.default)},
    'about/index.html': {size: 47852, hash: '7f108a914c04abeda3f03d1b62806ab73e7c306bd402e77b75c91c27eaa793fb', text: () => import('./assets-chunks/about_index_html.mjs').then(m => m.default)},
    'productlist/index.html': {size: 53307, hash: 'fcb02953b49ac0f48016eff75709e70c65553b3d09032b69a8fc93b8537bfd3d', text: () => import('./assets-chunks/productlist_index_html.mjs').then(m => m.default)},
    'productreport/index.html': {size: 42023, hash: '3244aa653871304f8c32c10d65030b07214ac3058eaa2f4932b00b41901c33ef', text: () => import('./assets-chunks/productreport_index_html.mjs').then(m => m.default)},
    'contact/index.html': {size: 47319, hash: '1cd86a93553cb1771a15b268d50eb85434aeaf35ea1242f45f4b564bc791be8c', text: () => import('./assets-chunks/contact_index_html.mjs').then(m => m.default)},
    'pdfreport/index.html': {size: 42315, hash: '85bef9a635086275d81892d963c63575df9a4b34ac9d600a5de24e05c5672efc', text: () => import('./assets-chunks/pdfreport_index_html.mjs').then(m => m.default)},
    'productcatalog/index.html': {size: 48592, hash: 'cfd9ae0bb25dbeee8c2856a64c4721110be23e03ac41d4405a18ac08396ef162', text: () => import('./assets-chunks/productcatalog_index_html.mjs').then(m => m.default)},
    'styles-3TD3YHK2.css': {size: 383328, hash: 'vqUxZXEylKI', text: () => import('./assets-chunks/styles-3TD3YHK2_css.mjs').then(m => m.default)}
  },
};
