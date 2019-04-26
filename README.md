UF CLAS EMILY Theme
==================

Theme for the College of Liberal Arts and Sciences homesite

```
Theme URI:    http://publications.clas.ufl.edu
Description:  Theme for the College of Liberal Arts and Sciences homesite
Author:       Yash Singh
Author URI:   https://comms.clas.ufl.edu/the-team/
Template:     twentyseventeen
```

Documentation
-------------

### Theme Updates

If there are templates and functions in the Twenty Seventeen parent theme that have the same name, the files in this theme override them. 

Some files may need to be updated to support new features or fixes in Twenty Seventeen beyond v2.1. 

### Page Templates

The page templates in this theme can be applied to pages and posts.

- Featured Story
- Full Width Post
- Image Header
- Left Sidebar
- Right Sidebar
- Magazine Article
- News Article

### Sidebars and Widgets

By default the sidebars have been removed from this theme's templates. In order to make sidebars visible, you have to select a page template that supports it. 

Pages that support sidebars and widgets:

- Left Sidebar page template
- Right Sidebar page template
- Archive pages (index.php)

### Navigation Menus

The menu location areas below require a menu:

- Top Menu - displays 3 levels of links
- Quick Links - displays 1 level of links
- Footer Column 1
- Footer Column 2
- Footer Column 3

#### Keyboard Navigation

Keyboard users can use the tab key to navigate through the menus, links, and buttons on the page. Users will see an outline around the current link/element.

### SVG Icons & Images

This theme uses a customized version of the ``twentyseventeen_get_svg`` function in its inc/icon-functions folder, which overrides the file/function in the parent theme. 

SVGs are all separate symbols in assets/images/ufl.svg. All new SVG icons should be displayed in pages using the twentyseventeen_get_svg() function for consistency.

#### Fallback images
If a fallback png is needed for older browsers, it should be defined in the symbol using the ``<image>`` tag workaround. Note: this is not valid HTML markup. See [CSS Tricks: A Complete Guide to SVG Fallbacks](https://css-tricks.com/a-complete-guide-to-svg-fallbacks/).

#### Accessible SVGs

SVG images that are not used as buttons or images are hidden by default. As a fallback for screenreaders, the theme uses hidden ``<span class="SVGaltText">`` after the SVG element.

See the inline SVG technique mentioned in [Accessible SVGs](https://css-tricks.com/accessible-svgs/). 

### Custom Fields

This theme can display the built-in WordPress custom fields and ACF Fields if they exist.

Page Templates with custom fields:

- Featured Story Page Template: sub_head
- Magazine Article Page Template: sub_head, byline
- Image Header: sub_head, header_image

Featured image custom field (caption is a WP field): 

- photo_credit_txt

### Stylesheets

Parent theme styles are not used. The theme includes these stylesheets:

- style.min.css - minified child theme styles
- assets/css/inline.min.css - minified inline styles from advancement.clas.ufl.edu (unclear where these styles are used)

The main stylesheet divides the styles into sections with media queries. Since these styles are redefined for each breakpoints instead of overriding previous styles, styles appear multiple times for each breakpoint. This can be solved using cascading, SASS, and using a mobile-first structure. 

**Note: When updating any styles, be sure to search and update each breakpoint.**


### JavaScript

The JS files are minified and combined in the main JS file, script.min.js.

Custom JS file:

- theme.js

Modified versions of parent theme files:

- global.js
- jquery.scrollTo.js
- navigation.js
- skip-link-focus-fix.js

Included from the parent theme:

- html5.js





