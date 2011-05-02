<!doctype html>
<html lang="en">
  <head>
    <title><?php echo $this->e($title)?: "Footle's (incomplete) guide to PHP"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet" type="text/css">
    <link href="/styles/main.css" rel="stylesheet" type="text/css"/>
    <link href="/styles/code-dark.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <h1><a href="/">Footle's (incomplete) guide to PHP</a></h1>

    <?php $this->render($subpage, $subpageData); ?>

    <footer>
      Credit to <a href="http://michelf.com/">Michel Fortin</a> for his <a href="http://michelf.com/projects/php-markdown/">Markdown parser</a>, 
      which I use here in a very slightly modified form.

      <?php if (isSet($lastModified) && $lastModified): ?>
        <div id="lastModified">
          This page last modified: <?php echo date(DATE_RSS, (int) $lastModified); ?>
        </div>
      <?php endif; ?>
    </footer>
  </body>
  <?php if(isSet($gaTracking) && $gaTracking): ?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-22278243-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  <?php endif; ?>
</html>
