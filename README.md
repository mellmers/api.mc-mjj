# Project-X REST-API @ HSBremen
Wir haben Vagrant nie auf allen drei Maschinen verlässlich zum Laufen bekommen, daher sind wir auf Xampp umgestiegen.
Diese Anleitung bezieht sich daher auf die Installation mit Xampp.

## Benötigte Software
- [Git](https://git-scm.com/)
- [XAMPP](https://www.apachefriends.org)
- [Composer](https://getcomposer.org/)
- Editor deiner Wahl (vorzugsweise [Phpstorm](https://www.jetbrains.com/phpstorm/))

## Initiales Setup
1. Xampp installieren
2. MySQL bereitstellen
3. Dieses Repo klonen `git clone git@github.com:Basster/hs-bremen-web-api.git`
4. Das gesamte Projekt für Xampp bereitstellen. (einfach alles in htdocs/(WUNSCHVERZEICHNIS) kopieren)
5. composer install im Stammverzeichnis ausführen

## Datenbank
Es wird ein Benutzer mit Namen 'project-x' und Passwort 'project-x' benötigt.
Ein Skript zum Erstellen der Datenbank sowie einiger Testdaten befindet sich im 'sql/' Ordner des Projektes.
Falls das Projekt in einer anderen Umgebung laufen soll, kann der Datenbankzugriff in der Datei 'src/database/databaseProvider.php' geändert werden.

## Lokale Tests mit PHPUnit
Sobald PHPUnit vorhanden ist, kann eine Run/Debug Config von Typ PHPUnit erstellt werden.
Test scope ist der 'tests/' Ordner im root Level des Projekts.

Für Code Coverage verwenden wir die Test Runner Option
```
-- whitelist src/
```

Außerdem wird ein aktives xDebug Modul benötigt.
Um zu testen, ob xDebug aktiv ist, kann php -v ins Terminal eingegeben werden.
Der Output sollte wie folgt aussehen:
```
PHP 7.0.9 (cli) (built: Jul 20 2016 17:12:28) ( NTS )
Copyright (c) 1997-2016 The PHP Group
Zend Engine v3.0.0, Copyright (c) 1998-2016 Zend Technologies
    with Xdebug v2.4.0, Copyright (c) 2002-2016, by Derick Rethans
```

Falls das nicht der Fall ist, hilft folgende Webseite:
[xDebug Wizard](https://xdebug.org/wizard.php)

## Swagger
Eine fertige Swagger.json befindet sich im 'documentation/' Ordner.
Außerdem wird in unserem Projekt SwaggerUI gehostet, um das Testen der Api zu erleichtern.
Der Pfad zur JSON sowie der basePath zum Testen ist für Xampp voreingestellt und kann anderenfalls in der SwaggerConfig ('src/SwaggerConfig.php') geändert werden.
Die SwaggerUI liegt unter "localhost/swaggerUI/".

## Team Mitglieder
- Thorben Werner - 383472
- Moritz Ellmers - 
- Jonas Oja - 386241
