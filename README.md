# API for Project-X @ HSBremen - REST-API

## Benötigte Software
- [Git](https://git-scm.com/)
- [XAMPP](https://www.apachefriends.org)
- [Composer](https://getcomposer.org/)
- [Phpstorm](https://www.jetbrains.com/phpstorm/)

## Initiales Setup
1. Xampp installieren
2. MySQL bereitstellen
3. Dieses Repo klonen
4. Das gesamte Projekt bei Xampp bereitstellen. (einfach alles in htdocs/ kopieren)
5. Composer install nicht vergessen

## Datenbank
Es wird ein Benutzer mit Namen 'project-x' und Passwort 'project-x' benötigt.
Ein Skript zum Erstellen der Datenbank sowie einiger Testbeispiele findet sich im 'sql/' Ordner des Projektes.
In Notfall kann dies im 'src/database/databaseProvider.php' geändert werden.

## Lokale Tests mit PHPUnit
Sobald PHPUnit vorhanden ist, kann eine Run/Debug Config von Typ PHPUnit erstellt werden.
Test scope ist der 'tests/' Ordner im root Level des Projekts.

Für Code Coverage verwenden wir die Test Runner Option
```
-- whitelist src/
```
Ausserdem wird ein aktives xDebug Modul benötigt.
Um zu testen, ob xDebug aktiv ist kann php -v ins Terminal eingegeben werden.
Der Output sollte so aussehen.
```
PHP 7.0.9 (cli) (built: Jul 20 2016 17:12:28) ( NTS )
Copyright (c) 1997-2016 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2016 Zend Technologies
    with Xdebug v2.4.0, Copyright (c) 2002-2016, by Derick Rethans

```
Falls das nicht der Fall ist hilft diese Webseite:
[xDebug Wizard](https://xdebug.org/wizard.php)

## Swagger
Eine fertige Swagger.json findet sich im 'documentation/' Ordner.
Ausserdem wird in unserem Projekt auch SwaggerUI gehostet um das Testen der Api zu erleichtern.
Der Pfad zur json sowie der basePath zum Testen ist für Xampp voreingestellt.

Zum Testen auf einer Vagrant Maschine genügt lediglich der Name des Servers als 'basePath'(swaggerConfig.php | Zeile 5). (MO?)
