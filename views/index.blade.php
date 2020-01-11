<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Altair</title>
  <base href="{{\XKojiMedia\AltairGraphQL\DownloadAssetsCommand::basePath()}}">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{\XKojiMedia\AltairGraphQL\DownloadAssetsCommand::faviconPath()}}">
  <link href="{{\XKojiMedia\AltairGraphQL\DownloadAssetsCommand::cssPath()}}" rel="stylesheet" />
</head>

<body>
  <app-root>
    <style>
      .loading-screen {
        display: none;
      }

    </style>
    <div class="loading-screen styled">
      <div class="loading-screen-inner">
        <div class="loading-screen-logo-container">
          <img src="assets/img/logo_350.svg" alt="Altair">
        </div>
        <div class="loading-screen-loading-indicator">
          <span class="loading-indicator-dot"></span>
          <span class="loading-indicator-dot"></span>
          <span class="loading-indicator-dot"></span>
        </div>
      </div>
    </div>
  </app-root>
  <script rel="preload" as="script" type="text/javascript" src="{{\XKojiMedia\AltairGraphQL\DownloadAssetsCommand::runtimeJsPath()}}"></script>
  <script rel="preload" as="script" type="text/javascript" src="{{\XKojiMedia\AltairGraphQL\DownloadAssetsCommand::polyfillsJsPath()}}"></script>
  <script rel="preload" as="script" type="text/javascript" src="{{\XKojiMedia\AltairGraphQL\DownloadAssetsCommand::mainJsPath()}}"></script>

  <script>
    var altairOptions = {
        endpointURL: "{{url(config('altair-graphql.endpoint'))}}"
    };

    window.addEventListener("load", function() {
      AltairGraphQL.init(altairOptions);
    });
  </script>
</body>

</html>
