# [WordPress Plugin - Advanced Job Openings](https://futurewordpress.com/wordpress/) 🎨
[![Project Status: Active.](https://www.repostatus.org/badges/latest/active.svg)](https://www.repostatus.org/#active) [![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg?style=flat-square)](https://github.com/prettier/prettier)

* A WordPress Plugin Project for Job opening platform.
This theme uses Bootstrap build package and JQuery package to build an Advanced WordPress Job openings from scratch


## Features

- ![](demo/Job%20Opening%20Job%20Lists.PNG)
- ![](demo/Job%20Opening%20Archive%20page.PNG)
- ![](demo/Job%20Opening%20Post%20New.PNG)

- Custom Archive page, Company single page, Company Archive page.
- Custom Blog Job list displayed in list format using bootstrap.
- Build in filters for job archive pages.
- API and HOOK on every where to customize it with no customizing.

## Maintainer

| Name                                                   | Github Username |
|--------------------------------------------------------|-----------------|
| [Remal Mahmud](mailto:info@futurewordpress.com)       |  @mahmudremal   |

## Usage

1. Clone the WordPress Plugin [AJO](https://github.com/mahmudremal/advanced-job-openings) in your WordPress
Plugin directory and activate it.

## Dashboard Setup.

1. Setup plugin from Settings > Job opening and setup what you actually need with language:
- ![](demo/Job%20Opening%20Setup%20Page.PNG)
2. Flush WordPress permalink by Settings > Permalinks and then clicking SAVE Changes button:
- ![](demo/Job%20Opening%20Permalink%20Flush.PNG)
## Development ( To be added )

**Install**

Clone the repo and run

```bash
cd advanced-job-openings/assets
npm install
```

**During development**

```bash
npm run dev
```

Run precommit from assets directory before pushing the code for development/contribution.

```
cd assets && npm run precommit
```

**Production**

```bash
npm run prod
```

**Linting & Formatting**

The following command will fix most errors and show and remaining ones which cannot be fixed automatically.

```bash
npm run lint:fix
```

We follow the stylelint configuration used in WordPress Gutenberg, run the following command to lint and fix styles.

```bash
npm run stylelint:fix
```

Format code with prettier ( TO BE ADDED )

```bash
npm run format-js
```

Directory Structure

```php
AJO:
│   .gitignore
│   advanced-job-openings.php
│   README.md
│   
├───assets
│   │   .babelrc
│   │   .eslintignore
│   │   .eslintrc.json
│   │   .nvmrc
│   │   .stylelintrc.json
│   │   webpack.config.js
│   │   
│   ├───build
│   │   │   assets.php
│   │   │   
│   │   ├───advanced-job-openings
│   │   │   └───assets
│   │   │       └───src
│   │   │           └───icons
│   │   │                   certificate.svg
│   │   │                   check.svg
│   │   │                   clock.svg
│   │   │                   controls.svg
│   │   │                   cross.svg
│   │   │                   empty-postbox.svg
│   │   │                   eye-open.svg
│   │   │                   gender.svg
│   │   │                   graduate-cap.svg
│   │   │                   line-chart.svg
│   │   │                   location-pin.svg
│   │   │                   man-in-office-desk-with-computer.svg
│   │   │                   mansion.svg
│   │   │                   money-cash.svg
│   │   │                   nill-frawn.svg
│   │   │                   notification.svg
│   │   │                   resume.svg
│   │   │                   right-arrow.svg
│   │   │                   star-fill.svg
│   │   │                   star-o.svg
│   │   │                   
│   │   ├───css
│   │   │       main.css
│   │   │       main.css.map
│   │   │       
│   │   ├───icons
│   │   │       certificate.svg
│   │   │       check.svg
│   │   │       clock.svg
│   │   │       controls.svg
│   │   │       cross.svg
│   │   │       empty-postbox.svg
│   │   │       eye-open.svg
│   │   │       gender.svg
│   │   │       graduate-cap.svg
│   │   │       line-chart.svg
│   │   │       location-pin.svg
│   │   │       man-in-office-desk-with-computer.svg
│   │   │       mansion.svg
│   │   │       money-cash.svg
│   │   │       nill-frawn.svg
│   │   │       notification.svg
│   │   │       resume.svg
│   │   │       right-arrow.svg
│   │   │       star-fill.svg
│   │   │       star-o.svg
│   │   │       
│   │   ├───images
│   │   │       cat.jpg
│   │   │       cats.jpg
│   │   │       cover.jpg
│   │   │       placeholder.png
│   │   │       
│   │   ├───js
│   │   │       main.js
│   │   │       main.js.map
│   │   │       
│   │   └───library
│   │       ├───css
│   │       │   │   ace-responsive-menu.css
│   │       │   │   admin.css
│   │       │   │   animate.css
│   │       │   │   bootstrap-grid.css
│   │       │   │   bootstrap-grid.min.css
│   │       │   │   bootstrap-select.min.css
│   │       │   │   bootstrap.min.css
│   │       │   │   fancyBox.css
│   │       │   │   flaticon.css
│   │       │   │   frontend-base.css
│   │       │   │   invoice.css
│   │       │   │   jquery-ui.min.css
│   │       │   │   menu.css
│   │       │   │   owl.css
│   │       │   │   progressbar.css
│   │       │   │   simplebar.min.css
│   │       │   │   slick-theme.css
│   │       │   │   slick.css
│   │       │   │   slider.css
│   │       │   │   timecounter.css
│   │       │   │   
│   │       │   └───map-css
│   │       │           info-box.css
│   │       │           maps.css
│   │       │           searcher.css
│   │       │           
│   │       ├───fonts
│   │       │   │   fonts.css
│   │       │   │   
│   │       │   └───flaticons
│   │       │           Flaticon.eot
│   │       │           Flaticon.html
│   │       │           Flaticon.svg
│   │       │           Flaticon.ttf
│   │       │           Flaticon.woff
│   │       │           Flaticon.woff2
│   │       │           
│   │       └───js
│   │               ace-responsive-menu.js
│   │               app.js
│   │               bootstrap-select.min.js
│   │               bootstrap.min.js
│   │               chart.min.js
│   │               jquery-scrolltofixed-min.js
│   │               jquery.counterup.js
│   │               jquery.mmenu.all.js
│   │               parallax.js
│   │               popper.min.js
│   │               progressbar.js
│   │               scrollto.js
│   │               simplebar.js
│   │               slick.min.js
│   │               slider.js
│   │               snackbar.min.js
│   │               timepicker.js
│   │               wow.min.js
│   │               
│   ├───src
│   │   ├───icons
│   │   │       certificate.svg
│   │   │       check.svg
│   │   │       clock.svg
│   │   │       controls.svg
│   │   │       cross.svg
│   │   │       empty-postbox.svg
│   │   │       eye-open.svg
│   │   │       gender.svg
│   │   │       graduate-cap.svg
│   │   │       line-chart.svg
│   │   │       location-pin.svg
│   │   │       man-in-office-desk-with-computer.svg
│   │   │       mansion.svg
│   │   │       money-cash.svg
│   │   │       nill-frawn.svg
│   │   │       notification.svg
│   │   │       resume.svg
│   │   │       right-arrow.svg
│   │   │       star-fill.svg
│   │   │       star-o.svg
│   │   │       
│   │   ├───img
│   │   │   │   cat.jpg
│   │   │   │   cats.jpg
│   │   │   │   placeholder.png
│   │   │   │   
│   │   │   └───patterns
│   │   │           cover.jpg
│   │   │           
│   │   ├───js
│   │   │   │   author.js
│   │   │   │   blocks.js
│   │   │   │   editor.js
│   │   │   │   main.js
│   │   │   │   single.js
│   │   │   │   
│   │   │   ├───carousel
│   │   │   │       index.js
│   │   │   │       
│   │   │   ├───clock
│   │   │   │       index.js
│   │   │   │       
│   │   │   ├───frontend
│   │   │   │       index.js
│   │   │   │       
│   │   │   ├───gutenberg
│   │   │   │   ├───block-extensions
│   │   │   │   │       register-block-styles.js
│   │   │   │   │       
│   │   │   │   └───blocks
│   │   │   │       ├───dos-and-donts
│   │   │   │       │       edit.js
│   │   │   │       │       index.js
│   │   │   │       │       templates.js
│   │   │   │       │       
│   │   │   │       └───heading-with-icon
│   │   │   │               edit.js
│   │   │   │               icons-map.js
│   │   │   │               index.js
│   │   │   │               
│   │   │   ├───icons
│   │   │   │       Check.js
│   │   │   │       Cross.js
│   │   │   │       index.js
│   │   │   │       
│   │   │   └───posts
│   │   │           loadmore-single.js
│   │   │           loadmore.js
│   │   │           main.js
│   │   │           
│   │   ├───library
│   │   │   ├───css
│   │   │   │   │   ace-responsive-menu.css
│   │   │   │   │   admin.css
│   │   │   │   │   animate.css
│   │   │   │   │   bootstrap-grid.css
│   │   │   │   │   bootstrap-grid.min.css
│   │   │   │   │   bootstrap-select.min.css
│   │   │   │   │   bootstrap.min.css
│   │   │   │   │   fancyBox.css
│   │   │   │   │   flaticon.css
│   │   │   │   │   frontend-base.css
│   │   │   │   │   invoice.css
│   │   │   │   │   jquery-ui.min.css
│   │   │   │   │   menu.css
│   │   │   │   │   owl.css
│   │   │   │   │   progressbar.css
│   │   │   │   │   simplebar.min.css
│   │   │   │   │   slick-theme.css
│   │   │   │   │   slick.css
│   │   │   │   │   slider.css
│   │   │   │   │   timecounter.css
│   │   │   │   │   
│   │   │   │   └───map-css
│   │   │   │           info-box.css
│   │   │   │           maps.css
│   │   │   │           searcher.css
│   │   │   │           
│   │   │   ├───fonts
│   │   │   │   │   fonts.css
│   │   │   │   │   
│   │   │   │   └───flaticons
│   │   │   │           Flaticon.eot
│   │   │   │           Flaticon.html
│   │   │   │           Flaticon.svg
│   │   │   │           Flaticon.ttf
│   │   │   │           Flaticon.woff
│   │   │   │           Flaticon.woff2
│   │   │   │           
│   │   │   └───js
│   │   │           ace-responsive-menu.js
│   │   │           app.js
│   │   │           bootstrap-select.min.js
│   │   │           bootstrap.min.js
│   │   │           chart.min.js
│   │   │           jquery-scrolltofixed-min.js
│   │   │           jquery.counterup.js
│   │   │           jquery.mmenu.all.js
│   │   │           parallax.js
│   │   │           popper.min.js
│   │   │           progressbar.js
│   │   │           scrollto.js
│   │   │           simplebar.js
│   │   │           slick.min.js
│   │   │           slider.js
│   │   │           snackbar.min.js
│   │   │           timepicker.js
│   │   │           wow.min.js
│   │   │           
│   │   └───sass
│   │       │   blocks.scss
│   │       │   editor.scss
│   │       │   frontend.scss
│   │       │   invoice.scss
│   │       │   main.scss
│   │       │   single.scss
│   │       │   _essentials.scss
│   │       │   
│   │       ├───0-settings
│   │       │       _background.scss
│   │       │       _colors.scss
│   │       │       _margin.scss
│   │       │       _settings.scss
│   │       │       _typography.scss
│   │       │       _variables.scss
│   │       │       _z-index.scss
│   │       │       
│   │       ├───1-tools
│   │       │       _functions.scss
│   │       │       _mixins.scss
│   │       │       _placeholders.scss
│   │       │       _tools.scss
│   │       │       
│   │       ├───2-generic
│   │       │       _buttons.scss
│   │       │       _common-classes.scss
│   │       │       _editor-color-classes.scss
│   │       │       _elements.scss
│   │       │       _generic.scss
│   │       │       _gutenberg.scss
│   │       │       _icons.scss
│   │       │       _normalize.scss
│   │       │       _search-results.scss
│   │       │       _slick-carousel.scss
│   │       │       _wp-css.scss
│   │       │       
│   │       ├───3-utilities
│   │       │       _animations.scss
│   │       │       
│   │       ├───4-layouts
│   │       │   │   _search-form.scss
│   │       │   │   
│   │       │   ├───header
│   │       │   │   └───nav
│   │       │   │           _navigation.scss
│   │       │   │           
│   │       │   └───posts
│   │       │           _meta.scss
│   │       │           _pagination.scss
│   │       │           _post-card.scss
│   │       │           
│   │       ├───6-editor
│   │       │       _editor.scss
│   │       │       
│   │       └───7-blocks
│   │               _button.scss
│   │               _dos-and-donts.scss
│   │               _heading-with-icon.scss
│   │               _quote.scss
│   │               
│   └───trash
│       └───template
│           │   forms.html
│           │   jobs-card.html
│           │   
│           └───css
│                   forms-input.css
│                   forms-output.css
│                   job-card.css
│                   
├───demo
│       Job Opening Archive page.PNG
│       Job Opening Job Lists.PNG
│       Job Opening Permalink Flush.PNG
│       Job Opening Post New.PNG
│       Job Opening Setup Page.PNG
│       
├───inc
│   ├───classes
│   │   │   class-archive-settings.php
│   │   │   class-assets.php
│   │   │   class-blocks.php
│   │   │   class-dashboard.php
│   │   │   class-database.php
│   │   │   class-hooks.php
│   │   │   class-invoices.php
│   │   │   class-loadmore-posts.php
│   │   │   class-loadmore-single.php
│   │   │   class-menus.php
│   │   │   class-meta-boxes.php
│   │   │   class-option.php
│   │   │   class-post-types.php
│   │   │   class-project.php
│   │   │   class-requests.php
│   │   │   class-shortcodes.php
│   │   │   class-sidebars.php
│   │   │   class-taxonomies.php
│   │   │   class-update.php
│   │   │   class-video.php
│   │   │   class-widgets.php
│   │   │   class-zip.php
│   │   │   
│   │   └───loader
│   │           class-metabox.php
│   │           class-option.php
│   │           
│   ├───frameworks
│   │   ├───codestar
│   │   └───tcpdf
│   │       │   example.php
│   │       │   invoice.svg
│   │       │   LICENSE.TXT
│   │       │   tcpdf.php
│   │       │   tcpdf_autoconfig.php
│   │       │   tcpdf_barcodes_1d.php
│   │       │   tcpdf_barcodes_2d.php
│   │       │   tcpdf_import.php
│   │       │   tcpdf_parser.php
│   │       │   
│   │       ├───fonts
│   │       │       courier.php
│   │       │       courierb.php
│   │       │       courierbi.php
│   │       │       courieri.php
│   │       │       freesans.ctg.z
│   │       │       freesans.php
│   │       │       freesans.z
│   │       │       freesansb.ctg.z
│   │       │       freesansb.php
│   │       │       freesansb.z
│   │       │       freesansbi.ctg.z
│   │       │       freesansbi.php
│   │       │       freesansbi.z
│   │       │       freesansi.ctg.z
│   │       │       freesansi.php
│   │       │       freesansi.z
│   │       │       helvetica.php
│   │       │       helveticab.php
│   │       │       helveticabi.php
│   │       │       helveticai.php
│   │       │       
│   │       └───include
│   │           │   sRGB.icc
│   │           │   tcpdf_colors.php
│   │           │   tcpdf_filters.php
│   │           │   tcpdf_fonts.php
│   │           │   tcpdf_font_data.php
│   │           │   tcpdf_images.php
│   │           │   tcpdf_static.php
│   │           │   
│   │           └───barcodes
│   │                   datamatrix.php
│   │                   pdf417.php
│   │                   qrcode.php
│   │                   
│   ├───helpers
│   │       autoloader.php
│   │       template-tags.php
│   │       
│   └───traits
│           trait-singleton.php
│           
├───languages
│       README.md
│       
└───template-parts
    │   apply.php
    │   
    ├───company
    │       archive.php
    │       single.php
    │       
    ├───dashboard
    │   │   dashboard.php
    │   │   
    │   ├───candidate
    │   │       agenda.php
    │   │       apply.php
    │   │       cvmanager.php
    │   │       favourite.php
    │   │       home.php
    │   │       invoice.php
    │   │       
    │   └───company
    │           application.php
    │           home.php
    │           managejobs.php
    │           post.php
    │           profile.php
    │           resumes.php
    │           
    └───jobs
            apply.php
            archive.php
            dashboard.php
            list.php
            single.php
```

### Fixing Errors

1. Error: Node Sass does not yet support your current environment
Solution : 
```shell
cd assets
npm rebuild node-sass
```
>>>>>>> 89aaed2b2f5d223c918f3e55f13f14c4c75ba2bb
