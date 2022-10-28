<<<<<<< HEAD
=======
# [WordPress Plugin - Advanced Job Openings](https://futurewordpress.com/wordpress/) 🎨
[![Project Status: Active.](https://www.repostatus.org/badges/latest/active.svg)](https://www.repostatus.org/#active) [![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg?style=flat-square)](https://github.com/prettier/prettier)

* A WordPress Plugin Project for Job opening platform.
This theme uses Bootstrap build package and JQuery package to build an Advanced WordPress Job openings from scratch


## Features

- ![](demo/features-one.png)

- ![](demo/features-two.png)

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

- ![](demo/setup-page.png)

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
.
Folder PATH listing for volume C: Local Disk
Volume serial number is 0E58-6FE6
C:.
│   .gitignore
│   advanced-job-openings.php
│   README.md
│   
├───.vscode
│       settings.json
│       
├───assets
│   │   .babelrc
│   │   .eslintignore
│   │   .eslintrc.json
│   │   .nvmrc
│   │   .stylelintrc.json
│   │   package-lock.json
│   │   package.json
│   │   webpack.config.js
│   │   
│   ├───build
│   │   │   assets.php
│   │   │   
│   │   ├───css
│   │   │       blocks.css
│   │   │       editor.css
│   │   │       main.css
│   │   │       single.css
│   │   │       
│   │   ├───js
│   │   │       author.js
│   │   │       blocks.js
│   │   │       editor.js
│   │   │       main.js
│   │   │       single.js
│   │   │       
│   │   ├───library
│   │   │   ├───css
│   │   │   │       bootstrap-grid.css
│   │   │   │       bootstrap-grid.min.css
│   │   │   │       bootstrap.min.css
│   │   │   │       slick-theme.css
│   │   │   │       slick.css
│   │   │   │       
│   │   │   ├───fonts
│   │   │   │   │   fonts.css
│   │   │   │   │   
│   │   │   │   └───lato-v16-latin
│   │   │   │           lato-v16-latin-300.eot
│   │   │   │           lato-v16-latin-300.svg
│   │   │   │           lato-v16-latin-300.ttf
│   │   │   │           lato-v16-latin-300.woff
│   │   │   │           lato-v16-latin-300.woff2
│   │   │   │           lato-v16-latin-300italic.eot
│   │   │   │           lato-v16-latin-300italic.svg
│   │   │   │           lato-v16-latin-300italic.ttf
│   │   │   │           lato-v16-latin-300italic.woff
│   │   │   │           lato-v16-latin-300italic.woff2
│   │   │   │           lato-v16-latin-700.eot
│   │   │   │           lato-v16-latin-700.woff
│   │   │   │           lato-v16-latin-700.woff2
│   │   │   │           lato-v16-latin-700italic.eot
│   │   │   │           lato-v16-latin-700italic.svg
│   │   │   │           lato-v16-latin-700italic.ttf
│   │   │   │           lato-v16-latin-700italic.woff
│   │   │   │           lato-v16-latin-700italic.woff2
│   │   │   │           lato-v16-latin-italic.eot
│   │   │   │           lato-v16-latin-italic.svg
│   │   │   │           lato-v16-latin-italic.ttf
│   │   │   │           lato-v16-latin-italic.woff
│   │   │   │           lato-v16-latin-italic.woff2
│   │   │   │           lato-v16-latin-regular.eot
│   │   │   │           lato-v16-latin-regular.svg
│   │   │   │           lato-v16-latin-regular.ttf
│   │   │   │           lato-v16-latin-regular.woff
│   │   │   │           lato-v16-latin-regular.woff2
│   │   │   │           
│   │   │   └───js
│   │   │           bootstrap.min.js
│   │   │           slick.min.js
│   │   │           
│   │   └───src
│   │       ├───img
│   │       │   │   cats.jpg
│   │       │   │   
│   │       │   └───patterns
│   │       │           cover.jpg
│   │       │           
│   │       └───library
│   │           └───fonts
│   │               └───lato-v16-latin
│   │                       lato-v16-latin-300.eot
│   │                       lato-v16-latin-300.svg
│   │                       lato-v16-latin-300.ttf
│   │                       lato-v16-latin-300.woff
│   │                       lato-v16-latin-300.woff2
│   │                       lato-v16-latin-300italic.eot
│   │                       lato-v16-latin-300italic.svg
│   │                       lato-v16-latin-300italic.ttf
│   │                       lato-v16-latin-300italic.woff
│   │                       lato-v16-latin-300italic.woff2
│   │                       lato-v16-latin-700.eot
│   │                       lato-v16-latin-700.svg
│   │                       lato-v16-latin-700.ttf
│   │                       lato-v16-latin-700.woff
│   │                       lato-v16-latin-700.woff2
│   │                       lato-v16-latin-700italic.eot
│   │                       lato-v16-latin-700italic.svg
│   │                       lato-v16-latin-700italic.ttf
│   │                       lato-v16-latin-700italic.woff
│   │                       lato-v16-latin-700italic.woff2
│   │                       lato-v16-latin-italic.eot
│   │                       lato-v16-latin-italic.svg
│   │                       lato-v16-latin-italic.ttf
│   │                       lato-v16-latin-italic.woff
│   │                       lato-v16-latin-italic.woff2
│   │                       lato-v16-latin-regular.eot
│   │                       lato-v16-latin-regular.svg
│   │                       lato-v16-latin-regular.ttf
│   │                       lato-v16-latin-regular.woff
│   │                       lato-v16-latin-regular.woff2
│   │                       
│   └───src
│       ├───icons
│       │       certificate.svg
│       │       clock.svg
│       │       controls.svg
│       │       cross.svg
│       │       eye-open.svg
│       │       gender.svg
│       │       graduate-cap.svg
│       │       line-chart.svg
│       │       location-pin.svg
│       │       man-in-office-desk-with-computer.svg
│       │       mansion.svg
│       │       money-cash.svg
│       │       notification.svg
│       │       resume.svg
│       │       right-arrow.svg
│       │       star-fill.svg
│       │       star-o.svg
│       │       
│       ├───img
│       │   │   cat.jpg
│       │   │   cats.jpg
│       │   │   
│       │   └───patterns
│       │           cover.jpg
│       │           
│       ├───js
│       │   │   author.js
│       │   │   blocks.js
│       │   │   editor.js
│       │   │   main.js
│       │   │   single.js
│       │   │   
│       │   ├───carousel
│       │   │       index.js
│       │   │       
│       │   ├───clock
│       │   │       index.js
│       │   │       
│       │   ├───gutenberg
│       │   │   ├───block-extensions
│       │   │   │       register-block-styles.js
│       │   │   │       
│       │   │   └───blocks
│       │   │       ├───dos-and-donts
│       │   │       │       edit.js
│       │   │       │       index.js
│       │   │       │       
│       │   │       └───heading-with-icon
│       │   │               edit.js
│       │   │               icons-map.js
│       │   │               index.js
│       │   │               
│       │   ├───icons
│       │   │       Check.js
│       │   │       Cross.js
│       │   │       index.js
│       │   │       
│       │   └───posts
│       │           loadmore-single.js
│       │           loadmore.js
│       │           
│       ├───library
│       │   ├───css
│       │   │   │   ace-responsive-menu.css
│       │   │   │   admin.css
│       │   │   │   animate.css
│       │   │   │   bootstrap-grid.css
│       │   │   │   bootstrap-grid.min.css
│       │   │   │   bootstrap-select.min.css
│       │   │   │   bootstrap.min.css
│       │   │   │   fancyBox.css
│       │   │   │   flaticon.css
│       │   │   │   frontend-base.css
│       │   │   │   jquery-ui.min.css
│       │   │   │   menu.css
│       │   │   │   owl.css
│       │   │   │   progressbar.css
│       │   │   │   simplebar.min.css
│       │   │   │   slick-theme.css
│       │   │   │   slick.css
│       │   │   │   slider.css
│       │   │   │   timecounter.css
│       │   │   │   
│       │   │   ├───map-css
│       │   │   │       info-box.css
│       │   │   │       maps.css
│       │   │   │       searcher.css
│       │   │   │       
│       │   │   └───template
│       │   │       │   forms.html
│       │   │       │   jobs-card.html
│       │   │       │   
│       │   │       └───css
│       │   │               forms-input.css
│       │   │               forms-output.css
│       │   │               job-card.css
│       │   │               
│       │   ├───fonts
│       │   │   │   fonts.css
│       │   │   │   
│       │   │   └───flaticons
│       │   │           Flaticon.eot
│       │   │           Flaticon.svg
│       │   │           Flaticon.ttf
│       │   │           Flaticon.woff
│       │   │           Flaticon.woff2
│       │   │           
│       │   └───js
│       │           ace-responsive-menu.js
│       │           app.js
│       │           bootstrap-select.min.js
│       │           bootstrap.min.js
│       │           chart.min.js
│       │           jquery-scrolltofixed-min.js
│       │           jquery.counterup.js
│       │           jquery.mmenu.all.js
│       │           parallax.js
│       │           popper.min.js
│       │           progressbar.js
│       │           scrollto.js
│       │           simplebar.js
│       │           slick.min.js
│       │           slider.js
│       │           snackbar.min.js
│       │           timepicker.js
│       │           wow.min.js
│       │           
│       └───sass
│           │   blocks.scss
│           │   editor.scss
│           │   main.scss
│           │   single.scss
│           │   _essentials.scss
│           │   
│           ├───0-settings
│           │       _colors.scss
│           │       _settings.scss
│           │       _typography.scss
│           │       _variables.scss
│           │       _z-index.scss
│           │       
│           ├───1-tools
│           │       _functions.scss
│           │       _mixins.scss
│           │       _placeholders.scss
│           │       _tools.scss
│           │       
│           ├───2-generic
│           │       _buttons.scss
│           │       _common-classes.scss
│           │       _editor-color-classes.scss
│           │       _elements.scss
│           │       _generic.scss
│           │       _gutenberg.scss
│           │       _icons.scss
│           │       _normalize.scss
│           │       _search-results.scss
│           │       _slick-carousel.scss
│           │       _wp-css.scss
│           │       
│           ├───3-utilities
│           │       _animations.scss
│           │       
│           ├───4-layouts
│           │   │   _search-form.scss
│           │   │   
│           │   ├───header
│           │   │   └───nav
│           │   │           _navigation.scss
│           │   │           
│           │   └───posts
│           │           _meta.scss
│           │           _pagination.scss
│           │           _post-card.scss
│           │           
│           ├───6-editor
│           │       _editor.scss
│           │       
│           └───7-blocks
│                   _button.scss
│                   _dos-and-donts.scss
│                   _heading-with-icon.scss
│                   _quote.scss
│                   
├───demo
│       setup-page.PNG
│       
├───inc
│   ├───classes
│   │   │   class-archive-settings.php
│   │   │   class-assets.php
│   │   │   class-blocks.php
│   │   │   class-clock-widget.php
│   │   │   class-futurewordpress-database.php
│   │   │   class-futurewordpress-project.php
│   │   │   class-loadmore-posts.php
│   │   │   class-loadmore-single.php
│   │   │   class-meta-boxes.php
│   │   │   class-option.php
│   │   │   class-register-post-types.php
│   │   │   class-register-taxonomies.php
│   │   │   class-sidebars.php
│   │   │   class-update.php
│   │   │   class-video.php
│   │   │   class-zip.php
│   │   │   
│   │   └───loader
│   │           class-metabox.php
│   │           class-option.php
│   │           
│   ├───frameworks
│   │   └───codestar-framework
│   │       ├───assets
│   │       │   ├───images
│   │       │   │       checkerboard.png
│   │       │   │       wp-logo.svg
│   │       │   │       
│   │       │   └───js
│   │       │           main.min.js
│   │       │           
│   │       └───classes
│   │               fields.class.php
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
    ├───company
    │       archive.php
    │       single.php
    │       
    ├───dashboard
    │   ├───candidate
    │   │       apply.php
    │   │       cvmanager.php
    │   │       favourite.php
    │   │       home.php
    │   │       
    │   └───company
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
