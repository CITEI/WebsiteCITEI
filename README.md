# CITEI Website
This is the source code of the website built for CITEI (Centro de Inovação Tecnológica e Educação Inclusiva - Center of Inclusive Education and Technological Innovation).

## What is included?
**Main**
* Custom Theme
    * Custom Blocks (LazyBlocks)
* Custom Post Types (located at 'exported settings/custom_post...')
    * Custom Fields (located at 'exported_settings/advanced...')

**Plugins**
* LazyBlocks (Required)
* Advanced Custom Fields (Required)
* Custom Post Types (Required)
* OneClickAccessibility (Required)
* Block Manager (Required)

**Additional**
* VLibras (Brazilian signal language interpreter)

## What do I have to know before using this theme?
First, the theme needs some plugins because the interface won't work without them. But don't worry, TGM Plugin is already configured for displaying alerts of which plugins are not installed, once you activate the theme, and it will help you on installing them.

Second, you have to know this theme has specific logic for using it correctly, and some blocks may not work properly. One of the plugins is designated to block the incompatible blocks from the WordPress Editor so that you don't need to get stressed with this. Hence logic will be explained in the following section.

### The logic
For this theme, we have two main post templates, one related to a person's profile, and another related to products. 
* The first consists of a post that you can edit just like a document, and it will be displayed like this aside from a small card containing the picture (thumbnail of the post), summary, and a tag cloud of posts having tags with the title of this post (name of the person).

* The second is totally different from the last one. This template has a mandatory filling cover image (meta) which is displayed just after the header, and all after that is the content of the post. Furthermore, this template doesn't have a container to adjust padding, which implies using a 'section' block whenever you don't want to have a full-width component.

Additionally, these post templates are used in 5 different post types, which are: Grupos de Pesquisa (Research Groups), Produtos (Products), Projetos (Projects), Bolsistas (Students), and Pesquisadores (Researchers), the first three using products template, and the last two the person's template. 

### Why do I have to follow these guidelines?
Because it will force you to make a concise design and easy use website layout. But more than that, **THE THEME IS TOTALLY ACCESSIBLE**, even for screenreaders, and it requires these objects being used like this to let accessibility guaranteed.

### Is this theme responsive on different screen types?
Totally, it uses bootstrap for styles, and its functionalities to make it work well.

### Why someone else outside of CITEI should care for this?
Because of all the features mentioned before, this repository may be useful for you, if you are seeking an accessible WordPress website and if these templates are close to your needs. With a few modifications, this code can be yours (at least a part of it).
