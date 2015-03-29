# bbcode
bbcode parser Bundle for Symfony framework

## @TODO:
- documentation (!)
- youtube tag works not well (!)
- app/config.yml as configuration file - turn off tags / change size of youtube iframe etc.
- more and improve the quality of tests (!)

## works:
- Bold [b]..[/b] *
- Italic [i]..[/i] *
- Underline ([u]..[/u] - span style
- Colors [color=(black/#cccccc)]..[/color] - span style
- URL [url=(http..) target=(_blank/etc)]...[/url] (target is optional)
- vidoe [youtube]youtube-link[/youtube] // @TODO embed?
- image [img](http..)[/img]

## will work soon:
- youtube (with auto embed)


(*) probable will be changed to span style
