# Pixelbar Sponsor Plugin

## Beschreibung
Dieses Plugin erweitert Wordpress um einen weitere Custom-Post-Type "Banner". Neue Banner können in verschiedene Sektionen (Bannerplätze) aufgeteilt werden (Custom-Taxonomies).

## Eingabemöglichkeiten
Folgende Eingabemöglichkeiten gibt es:
 * Titel
 * URL
 * Banner (Bilddatei)
 
## Ausgabe
Die Ausgabe erfolgt über den Shortcode `[sponsoren]`. Dieser erlaubt verschiedene Parameter:
 * `platz` __(Name des Bannerplatzes)__ legt fest, von welchem Bannerplatz die Banner ausgegeben werden. Default ist __ALLE__
 * `large_col`, `medium_col`, `small_col` __(Zahl)__ ist spezifisch für das Foundation-Framework und legt fest, wieviele Kolonnen in jeweiligen Breakpoints angezeigt werden. Hier bitte das standard 12-er Grid beachten. Default is __4__.
 * `limit` __(Zahl)__ limitiert die Ausgabe.
 * `cycle` __(bool)__ legt fest, ob das Cycle Plugin auf die Ausgabe angewendet werden soll. Defaultwert kann im Backend festgelegt werden.
 * `animation` __(fade__ oder __slideHorz)__ legt die Animation des Slides fest. Defaultwert kann im Backend festgelegt werden.
 * `timeout` __(Zahl)__ legt die Pause zwischen zeit Slides fest. In Millisekunden (1000 = 1 Sek). Defaultwert kann im Backend festgelegt werden.
 * `show_pager` __(bool)__ legt fest, ob Vor- und Zurückpfeile angezeigt werden sollen. Defaultwert kann im Backend festgelegt werden.
 * `pause_on_hover` __(bool)__ legt fest, ob die Slideanimation stoppen soll, wenn man auf die Sponsoren hovert. Defaultwert kann im Backend festgelegt werden. 
 * `number_per_slide` __(Zahl)__ legt fest, wieviele Banner innerhalb eines Slides angezeigt werden sollen. Auch hier bitte das 12er Foundationgrid beachten. Defaultwert kann im Backend festgelegt werden.
 
## Standardwerte
Standardwerte können im Backend unter __Einstellungen__ -> __Sponsoren__ festgelegt werden.

