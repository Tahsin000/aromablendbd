$base = 'c:\Users\Asus\Downloads\paces-theme-dashboard\laravel-app\resources\views\admin'

$views = @{
  'projects'     = @('grid','list','details','kanban','team-board','activity')
  'tasks'        = @('list','details','create')
  'invoice'      = @('list','details','create')
  'crm'          = @('contacts','opportunities','deals','leads','pipeline','campaign','proposals','estimations','customers','activities')
  'users'        = @('contacts','profile','account-settings','roles','role-details','permissions')
  'finance'      = @('expenses','expense-category','income','transactions','banks-cards')
  'hrm'          = @('staffs','staff-profile','staff-add','departments','attendance','leaves','leave-add','holidays','payroll','create-salary-slip')
  'mail'         = @('inbox','details','compose','outlook')
  'support'      = @('ticket-list','ticket-details','ticket-create')
  'promo'        = @('coupons','gift-cards','discounts')
  'apps'         = @('chat','social-feed','pro-ai','file-manager','calendar','companies','todo','pin-board','clients','vote-list','issue-tracker','api-keys','manage')
  'blog'         = @('list','grid','article','add')
  'forum'        = @('view','post')
  'pages'        = @('about-us','contact-us','pricing','empty','timeline','gallery','faq','sitemap','search-results','coming-soon','privacy-policy','terms-conditions','users-profile')
  'auth'         = @('sign-in','sign-up','lock-screen','reset-pass','new-pass','login-pin','two-factor','success-mail','delete-account','card-sign-in','card-sign-up','card-lock-screen','card-reset-pass','card-new-pass','card-login-pin','card-two-factor','card-success-mail','card-delete-account','split-sign-in','split-sign-up','split-lock-screen','split-reset-pass','split-new-pass','split-login-pin','split-two-factor','split-success-mail','split-delete-account')
  'layouts-demo' = @('boxed','compact','horizontal','preloader','scrollable','sidebar-compact','sidebar-gradient','sidebar-gray','sidebar-image','sidebar-light','sidebar-no-icons','sidebar-offcanvas','sidebar-on-hover','sidebar-with-lines','topbar-dark','topbar-gradient','topbar-gray')
  'charts'       = @('apex-area','apex-bar','apex-boxplot','apex-bubble','apex-candlestick','apex-column','apex-funnel','apex-heatmap','apex-line','apex-mixed','apex-pie','apex-polar-area','apex-radar','apex-radialbar','apex-range','apex-scatter','apex-slope','apex-sparklines','apex-timeline','apex-treemap','chartjs-area','chartjs-bar','chartjs-line','chartjs-other','echart-area','echart-bar','echart-candlestick','echart-gauge','echart-geo-map','echart-heatmap','echart-line','echart-other','echart-pie','echart-radar','echart-scatter')
  'widgets'      = @('charts','mixed','social','statistics','weather')
  'forms'        = @('elements','layout','select','fileuploads','wizard','validation','pickers','range-slider','text-editors','other-plugin','cropper')
  'tables'       = @('static','custom','datatables-basic','datatables-ajax','datatables-checkbox-select','datatables-child-rows','datatables-column-searching','datatables-columns','datatables-export-data','datatables-fixed-columns','datatables-fixed-header','datatables-javascript','datatables-range-search','datatables-rendering','datatables-rows-add','datatables-scroll','datatables-select')
  'icons'        = @('lucide','remix','solar-duotone','tabler','flags')
  'maps'         = @('google','leaflet','vector')
  'plugins'      = @('sortable','pdf-viewer','i18','sweet-alerts','idle-timer','pass-meter','masonry','animation','tour','tree-view','clipboard','video-player')
  'ui'           = @('accordions','alerts','badges','breadcrumb','buttons','cards','carousel','collapse','colors','dropdowns','grid','images','links','list-group','modals','notifications','offcanvas','pagination','placeholders','popovers','progress','scrollspy','spinners','tabs','tooltips','typography','utilities','videos')
  'errors'       = @('400','401','403','404','408','500','maintenance')
  'ecommerce'    = @('products','products-grid','product-details','product-add','categories','orders','order-details','order-add','customers','cart','checkout','sellers','seller-details','refunds','reviews','warehouse','product-stocks','purchased-orders','product-views','sales','attributes','discount-edit','settings')
}

$count = 0
foreach ($folder in $views.Keys) {
  $dir = Join-Path $base $folder
  if (!(Test-Path $dir)) { New-Item -ItemType Directory -Path $dir | Out-Null }
  foreach ($view in $views[$folder]) {
    $file = Join-Path $dir "$view.blade.php"
    $title = (Get-Culture).TextInfo.ToTitleCase($view.Replace('-', ' '))
    $content = "@extends('admin.layouts.app')" + [Environment]::NewLine + [Environment]::NewLine +
               "@section('content')" + [Environment]::NewLine +
               "<div class=`"container-fluid`">" + [Environment]::NewLine +
               "    <h4>$title</h4>" + [Environment]::NewLine +
               "    {{-- TODO: extract main content from HTML-Template: $view.html --}}" + [Environment]::NewLine +
               "</div>" + [Environment]::NewLine +
               "@endsection" + [Environment]::NewLine
    if (!(Test-Path $file)) {
      Set-Content -Path $file -Value $content -Encoding UTF8
      $count++
    }
  }
}
Write-Output "Done! Created $count blade view files."
