# Konfiguration des Cronjobs

Anhand einer Datenbank-Migration des Plugins wird der Cronjob zur Umstellung
der Dateiverf�gbarkeit automatisch angelegt.

Der Cronjob kann �ber einen Parameter in der Datei config_local.inc.php konfiguriert werden.
Anhand des Parameters DOCUMENT_LICENSE_CHANGES_2017 kann der Download-Status
f�r Dokumente zum 1.1.2017 neu vergeben werden.

Der Parameter DOCUMENT_LICENSE_CHANGES_2017 muss ein assoziatives Array enthalten,
welches einer Lizenz-ID in der Tabelle "document_licenses"
einen neuen Download-Status zum 1.1.2017 zuweist.
Im Array sollten nur die �nderungen den Download-Status betreffend aufgef�hrt werden.
Unver�nderte Download-Status sollten nicht im Array aufgef�hrt werden.


## Beispiele f�r den Inhalt von DOCUMENT_LICENSE_CHANGES_2017:


Sollen alle Dokumente gesperrt werden, welche entweder nicht frei von
Rechten dritter sind (Lizenz-ID 1), eine ungekl�rte Lizenz haben (Lizenz-ID 2),
aus Abbildungen, Fotos, Filmen, Musikst�cken oder Partituren bestehen (Lizenz-ID 6)
oder aus publizierten Texten ohne erworbene Lizenz oder gesonderte Erlaubnis bestehen
(Lizenz-ID 7), so muss das Array folgenderma�en bef�llt werden:

    $DOCUMENT_LICENSE_CHANGES_2017 = array(
        '1' => '3',
        '2' => '3',
        '6' => '3',
        '7' => '3'
    );

Sollen nur die Dokumente zugelassen werden, welche frei von Rechten Dritter sind
(Lizenz-ID 0), aus einem selbst verfassten, nicht publiziertem Werk bestehen (Lizenz-ID 3)
oder aus einem Werk mit freier Lizenz bestehen (Lizenz-ID 4), so w�rde das assoziative
Array f�r DOCUMENT_LICENSE_CHANGES_2017 folgenderma�en aussehen:

    $DOCUMENT_LICENSE_CHANGES_2017 = array(
        '1' => '3',
        '2' => '3',
        '5' => '3',
        '6' => '3',
        '7' => '3'
    );

Soll hingegen zum 1.1. 2017 nichts am Lizenzstatus ge�ndert werden,
bleibt das Array einfach leer:

    $DOCUMENT_LICENSE_CHANGES_2017 = array();


Der Standardwert f�r das Array ist, nur Dokumente, welche publizierte Texte
ohne erworbene Lizenz oder gesonderte Erlaubnis enthalten (Lizenz-ID 7) 
zum 1.1.2017 zu sperren:

    $DOCUMENT_LICENSE_CHANGES_2017 = array(
        '7' => '3'
    );
