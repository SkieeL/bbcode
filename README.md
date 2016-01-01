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
- youtube [youtube](just place youtube hash)[/youtube]

## Instalation:

<section>
"require": {
        "Forti/bbcode": "1.0.x"
},
    "repositories": [
        {
            "type": "git",
            "url": "git@github.com:Fortidude/bbcode.git"
        }],
</section>

a następnie wpisać oczywiście komenda:

<section>
$ composer update
</section>

Dodajemy wpis do pliku AppKernel.php:

<section>
public function registerBundles()
    {
        $bundles = array(
        //...
                new Forti\bbcode\FortiBbcodeBundle(),
        //...
    }
</section>

i na sam koniec, w miejscu gdzie chcemy wyświetlać teksts, w twigu wystarczy wykorzystać rozszeżenie dla twiga "bbcode":

<section>
    {{ variable|bbcode }}
</section>


(*) probable will be changed to span style
