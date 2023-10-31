<?php

$lang = array_merge($lang,array(
	#Misc
	"GS_STR_DOWNLOAD" => "Pobierz",
	"GS_STR_TRANSLATION" => " ",
	"GS_STR_DISABLED" => "Wyłączone",
	"GS_STR_ENABLED" => "Włączone",
	"GS_STR_ADDED_BY" => "dodał",
	"GS_STR_ADDED_BY_ON" => "Dodał %m1% dnia %m2%",
	"GS_STR_MANAGED_BY_SINCE" => "Zarządzany przez %m1% od %m2%",
	"GS_STR_ERROR_EXPIRED" => "Strona straciła ważność. Spróbuj jeszcze raz od strony głównej",
	"GS_STR_ERROR_GET_DB_RECORD" => "Nie udało się załadować danych",
	"GS_STR_ERROR_FORMDATA" => "Niepoprawny formularz",
	"GS_STR_WEBSITE_TITLE" => "Rozkład Rozgrywek w OFP",
	"GS_STR_WEBSITE_DESCRIPTION" => "Przygotuj grę sieciową w OFP",
	"GS_STR_SHOW_CHANGELOG" => "Pokaż zmiany",
	"GS_STR_MOD_UPDATES" => "Jak są aktualizowane mody?",
	
    #Drop-down menu in the navigation bar
	"GS_STR_MENU_MODUPDATES" => "Aktualizacje modów",
    "GS_STR_MENU_INSTALLSCRIPTS" => "Skrypty instalacyjne",
	"GS_STR_MENU_QUICKSTART" => "Przewodnik",
	"GS_STR_MENU_DEDICATED" => "Serwer dedykowany",
	"GS_STR_MENU_VIDEOS" => "Filmy",
	"GS_STR_MENU_YOUTUBE" => "YouTube",
	"GS_STR_MENU_STEAM" => "Steam",
	"GS_STR_MENU_STEAMFORUM" => "Dyskusja na Steamie",
	"GS_STR_MENU_BI" => "Forum BI",
	"GS_STR_MENU_BIFORUM" => "Dyskusja na forum BI",
	"GS_STR_MENU_GOG" => "Forum GOG",
	"GS_STR_MENU_GOGFORUM" => "Dyskusja na forum GOG",
	"GS_STR_MENU_FACEBOOK" => "Facebook",
	"GS_STR_MENU_FACEBOOKFORUM" => "Dyskusja na Facebooku",
	"GS_STR_MENU_VK" => "VK",
	"GS_STR_MENU_VKFORUM" => "Dyskusja na VK",
	"GS_STR_MENU_TRANSLATION" => "Tłumaczenie",
	
    #Home page
	"GS_STR_INDEX_WELCOME" => "Witamy w Rozkładzie Rozgrywek do OFP",
	"GS_STR_INDEX_DESCRIPTION" => "Organizator gier sieciowych do Operation Flashpoint / ARMA: Cold War Assault",
	"GS_STR_INDEX_QUICKSTART" => "Rozpocznij",
	"GS_STR_INDEX_LEARN_MORE" => "Dowiedz się więcej",
	"GS_STR_INDEX_UPCOMING" => "Nadchodzące spotkania",
	"GS_STR_INDEX_PERSISTENT" => "Stałe serwery",
	"GS_STR_INDEX_ALLMODS" => "Wszystkie dostępne mody",
	"GS_STR_INDEX_RECENT" => "Ostatnia aktywność",
    "GS_STR_INDEX_MYSERVERS" => "Moje serwery",
    "GS_STR_INDEX_MYMODS" => "Moje mody",
	"GS_STR_INDEX_OURSERVERS" => "Wspólne serwery",
	"GS_STR_INDEX_OURMODS" => "Wspólne mody",
    "GS_STR_INDEX_ADDNEW_SERVER" => "Dodaj nowy serwer",
    "GS_STR_INDEX_ADDNEW_MOD" => "Dodaj nowy mod",
	"GS_STR_INDEX_EDIT" => "Szczegóły",
	"GS_STR_INDEX_SCHEDULE" => "Harmonogram",
	"GS_STR_INDEX_MODS" => "Mody",
	"GS_STR_INDEX_SHARE" => "Partnerzy",
	"GS_STR_INDEX_DELETE" => "Usuń",
	"GS_STR_INDEX_UPDATE" => "Zaktualizuj",
	"GS_STR_INDEX_INSTALLATION" => "Instalacja",
	"GS_STR_INDEX_LIMIT_REACHED" => "Maksymalna liczba wpisów",
	"GS_STR_INDEX_SHOW" => "Pokaż",
	"GS_STR_INDEX_NO_RECORDS" => "Brak wpisów",
	
    #Edit server details page
	"GS_STR_SERVER" => "Serwer",
	"GS_STR_SERVER_PAGE_TITLE" => "Informacje o serwerze %m1%",
	"GS_STR_SERVER_NAME" => "Nazwa",
	"GS_STR_SERVER_NAME_HINT" => "Pełna nazwa",
	"GS_STR_SERVER_NAME_EXAMPLE" => "Adama Kowalskiego serwer z modem WW4 i misjami",
	"GS_STR_SERVER_ADDRESS" => "Adres",
	"GS_STR_SERVER_ADDRESS_HINT" => "Adres IP serwera. Nie będzie pokazany publicznie",
	"GS_STR_SERVER_PASSWORD" => "Hasło",
	"GS_STR_SERVER_PASSWORD_HINT" => "Hasło jeśli jest wymagane do podłączenia się. Nie będzie pokazane publicznie",
	"GS_STR_SERVER_ACCESSCODE" => "Hasło w rozkładzie",
	"GS_STR_SERVER_ACCESSCODE_HINT" => "Napisz tutaj hasło żeby ukryć serwer w planie rozgrywek",
	"GS_STR_SERVER_VERSION" => "Wersja",
	"GS_STR_SERVER_VERSION_HINT" => "Wersja gry serwera",
	"GS_STR_SERVER_EQUALMODS" => "Wymagane identyczne mody",
	"GS_STR_SERVER_EQUALMODS_HINT" => "Włącz jeśli serwer wymaga od graczy załadowania identycznych modów",
	"GS_STR_SERVER_CUSTOMFILE" => "Maks. wielkość własnych plików",
	"GS_STR_SERVER_CUSTOMFILE_HINT" => "Dopuszczalna wielkość w bajtach własnych plików graczy ustawiona przez serwer (maksymalnie 102400)",
	"GS_STR_SERVER_LANGUAGES" => "Języki",
	"GS_STR_SERVER_LANGUAGES_HINT" => "Lista języków jakimi gracze mogą posługiwać się na serwerze",
	"GS_STR_SERVER_LOCATION" => "Położenie",
	"GS_STR_SERVER_LOCATION_HINT" => "Gdzie serwer znajduje się na świecie żeby gracze mogli przewidzieć jakość połączenia",
	"GS_STR_SERVER_MESSAGE" => "Uwagi",
	"GS_STR_SERVER_MESSAGE_HINT" => "Dodatkowa informacja dla graczy. Do 255 znaków",
	"GS_STR_SERVER_MESSAGE_EXAMPLE" => "Witaj Świecie!",
	"GS_STR_SERVER_WEBSITE" => "Strona WWW",
	"GS_STR_SERVER_WEBSITE_HINT" => "Adres do strony gdzie gracze mogą dowiedzieć się więcej na temat serwera",
	"GS_STR_SERVER_VOICE_ADDRESS" => "Adres kanału głosowego",
	"GS_STR_SERVER_VOICE_PROGRAM" => "Rozmowy głosowe",
	"GS_STR_SERVER_VOICE_HINT" => "Nie będzie pokazany publicznie",
	"GS_STR_SERVER_LOGO" => "Ikona",
	"GS_STR_SERVER_LOGO_HINT" => "Obraz JPG/PAA do \$max_image_size (zalecane 128x128). Gra musi zostać uruchomiona ponownie żeby obraz się odświeżył",
	"GS_STR_SERVER_SUBMIT" => "Zmień szczegóły",
	"GS_STR_SERVER_DRAGDROP" => "Przeciągnij tutaj pliki server.cfg oraz flashpoint.cfg / coldwarassault.cfg / armaresistance.cfg żeby automatycznie wypełnić niektóre pola formularza",
	"GS_STR_SERVER_SELECT_FILES" => "Wybierz Pliki",
	"GS_STR_SERVER_PERSISTENT" => "Harmonogram",
	"GS_STR_SERVER_PERSISTENT_HINT" => "Czy ten serwer ma konkretne czasy grania?",
	"GS_STR_SERVER_PERSISTENT_OFF" => "Ten serwer nie ma harmonogramu. Niech ciągle będzie na liście",
	"GS_STR_SERVER_PICK_IP" => "Wybierz adres z listy serwerów",
	"GS_STR_SERVER_MASTER_LIST" => "Główna lista serwerów",
	"GS_STR_SERVER_MASTER_5MIN" => "Źródło: <a href=\"master.ofpisnotdead.com\">master.ofpisnotdead.com</a>. Aktualizowana co 5 minut",

    #Edit server details page feedback
	"GS_STR_SERVER_URL_ERROR" => "Błędny adres strony",
	"GS_STR_SERVER_VOICE_ERROR" => "Błędny adres do rozmów głosowych",
    "GS_STR_SERVER_ADDED" => "Wpis serwera dodany",
    "GS_STR_SERVER_UPDATED" => "Wpis serwera zaktualizowany",
	"GS_STR_SERVER_ADDED_ERROR" => "Nie udało się dodać nowego serwera",
	"GS_STR_SERVER_UPDATED_ERROR" => "Nie udało się zaktualizować serwera",
	"GS_STR_SERVER_NOPERM_ERROR" => "Nie masz pozwolenia na zmienianie tego serwera",
	"GS_STR_SERVER_MAX_ERROR" => "Nie można przekroczyć dozwolonej liczby serwerów",
	"GS_STR_SERVER_REMOVED_ERROR" => "Serwer został usunięty",
    
    #Display server info page
	"GS_STR_SERVER_MODS" => "Mody",
	"GS_STR_SERVER_GAMETIME" => "Harmonogram",
	"GS_STR_SERVER_HOWTO_CONNECT" => "Jak dołączyć",
	"GS_STR_SERVER_STATUS" => "Stan",
	"GS_STR_SERVER_OFFLINE" => "Brak połączenia",
	"GS_STR_SERVER_CREATE" => "Tworzenie",
	"GS_STR_SERVER_EDIT" => "Edycja",
	"GS_STR_SERVER_WAIT" => "Oczekiwanie",
	"GS_STR_SERVER_SETUP" => "Ustawianie",
	"GS_STR_SERVER_DEBRIEFING" => "Sprawozdanie",
	"GS_STR_SERVER_BRIEFING" => "Odprawa",
	"GS_STR_SERVER_PLAY" => "Gra",
	"GS_STR_SERVER_MISSION" => "Misja",
	"GS_STR_SERVER_PLAYERS" => "Gracze",

    #Edit server schedule page
	"GS_STR_SERVER_EVENT_PAGE_TITLE" => "Harmonogram serwera %m1%",
	"GS_STR_SERVER_EVENT_DATE" => "Data i godzina",
	"GS_STR_SERVER_EVENT_TIMEZONE" => "Strefa czasowa",
	"GS_STR_SERVER_EVENT_REPEAT" => "Okresowość",
	"GS_STR_SERVER_EVENT_REPEAT_SINGLE" => "Pojedyncza sesja",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY" => "Raz w tygodniu",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC0" => "W każdą niedzielę",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC1" => "W każdy poniedziałek",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC2" => "W każdy wtorek",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC3" => "W każdą środę",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC4" => "W każdy czwartek",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC5" => "W każdy piątek",
	"GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC6" => "W każdą sobotę",
	"GS_STR_SERVER_EVENT_REPEAT_DAILY" => "Codziennie",
	"GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC" => "Codziennie",
	"GS_STR_SERVER_EVENT_LENGTH" => "Czas trwania",
	"GS_STR_SERVER_EVENT_MINUTES" => "w minutach",
	"GS_STR_SERVER_EVENT_BREAKSTART" => "Początek okresu przerwy",
	"GS_STR_SERVER_EVENT_BREAKEND" => "Ostatni dzień okresu przerwy",
	"GS_STR_SERVER_EVENT_SUBMIT" => "Dodaj nową sesję",
	"GS_STR_SERVER_EVENT_EDIT" => "Zmień zaznaczony",
	"GS_STR_SERVER_EVENT_CURRENT" => "Obecny rozkład",
	"GS_STR_SERVER_EVENT_REMOVE" => "Usuń Zaznaczone",
	"GS_STR_SERVER_EVENT_NOW" => "Teraz",
	"GS_STR_SERVER_EVENT_EXPIRED" => "Sesja przedawniona",
	"GS_STR_SERVER_EVENT_VACATION" => "Przerwa do",
    
    #Edit server schedule page feedback
	"GS_STR_SERVER_EVENT_UPDATE" => "Sesja zaktulizowana",
	"GS_STR_SERVER_EVENT_ADDED" => "Sesja dodana",
	"GS_STR_SERVER_EVENT_REMOVED" => "Odwołano %m1% ses%m2%",
	"GS_STR_SERVER_EVENT_NONE_ERROR" => "Nie zaznaczono sesji",
	"GS_STR_SERVER_EVENT_UPDATE_ERROR" => "Nie udało się zaktualizować tego wpisu",
	"GS_STR_SERVER_EVENT_MULTI_ERROR" => "Wybierz jedną sesję do poprawki",
	"GS_STR_SERVER_EVENT_ADDED_ERROR" => "Nie udało się dodać nowej sesji",
	"GS_STR_SERVER_EVENT_MAX_ERROR" => "Harmonogram jest pełny",
	"GS_STR_SERVER_EVENT_REMOVED_ERROR" => "Nie udało się usunąć sesji",
	
    #Edit server mods page
	"GS_STR_SERVER_MOD_PAGE_TITLE" => "Mody na serwerze %m1%",
	"GS_STR_SERVER_MOD_AVAILABLE" => "Dostępne mody",
	"GS_STR_SERVER_MOD_AVAILABLE_HINT" => "Dodaj mody w takiej samej koleności w jakiej są ładowane na serwerze",
	"GS_STR_SERVER_MOD_FULL" => "Serwer jest pełny",
	"GS_STR_SERVER_MOD_NOTHING" => "Nie ma nic do dodania",
	"GS_STR_SERVER_MOD_CURRENT" => "Obecne mody",
	"GS_STR_SERVER_MOD_ASSIGN" => "Dodaj",
	"GS_STR_SERVER_MOD_SUBMIT" => "Zmień",
	"GS_STR_SERVER_MOD_DISCARD" => "Usuń",
    
    #Edit server mods feedback
	"GS_STR_SERVER_MOD_REMOVED" => "Usunięto %m1% mod%m2%",
	"GS_STR_SERVER_MOD_REMOVED_ERROR" => "Nie udało się usunąć modów",
	"GS_STR_SERVER_MOD_ADDED" => "Dodano %m1% mod%m2%",
	"GS_STR_SERVER_MOD_ADDED_ONE" => "Dodano mod %m1%",
	"GS_STR_SERVER_MOD_ADDED_ERROR" => "Nie udało się dodać modów",
	"GS_STR_SERVER_MOD_UPDATED" => "Zaktualizowano listę modów",
	"GS_STR_SERVER_MOD_CLEAR" => "Wyczyszczono listę modów",
	"GS_STR_SERVER_MOD_NOSEL_ERROR" => "Nie zaznaczono żadnych modów",
	"GS_STR_SERVER_MOD_MAX_ERROR" => "Serwer jest pełny",
	"GS_STR_SERVER_MOD_ALREADY_ERROR" => "Te mody zostały już dodane",
	
	#Edit mod details page
	"GS_STR_MOD" => "Mod",
	"GS_STR_MOD_PAGE_TITLE" => "Szczegóły moda %m1%",
	"GS_STR_MOD_FOLDER" => "Nazwa Folderu",
	"GS_STR_MOD_FOLDER_HINT" => "Nazwa modfolderu w katalogu z grą",
	"GS_STR_MOD_SUBTITLE" => "Podtytuł",
	"GS_STR_MOD_SUBTITLE_HINT" => "Druga nazwa dla odróżnienia tego moda od innych",
	"GS_STR_MOD_DESCRIPTION" => "Opis",
	"GS_STR_MOD_DESCRIPTION_HINT" => "O czym jest i kto jest autorem",
	"GS_STR_MOD_DESCRIPTION_EXAMPLE" => "Now modele jednostek i animacje autorstwa Sanctuariego",
	"GS_STR_MOD_ACCESS" => "Hasło",
	"GS_STR_MOD_ACCESS_HINT" => "Napisz tu hasło żeby ukryć ten mod",
	"GS_STR_MOD_PUBLIC" => "Publiczny",
	"GS_STR_MOD_PRIVATE" => "Prywatny",
	"GS_STR_MOD_FORCENAME" => "Wymuś Nazwę",
	"GS_STR_MOD_FORCENAME_HINT" => "Automatycznie przywróć oryginalną nazwę folderu jeśli gracz ją zmieni",
	"GS_STR_MOD_VERSION" => "Wersja",
	"GS_STR_MOD_VERSION_HINT" => "Numer pierwszej wersji moda",
	"GS_STR_MOD_INSTALLATION" => "Instalacja",
	"GS_STR_MOD_INSTALLATION_SCRIPT" => "Skrypt instalacyjny",
	"GS_STR_MOD_INSTALLATION_HINT" => "%m1%Instrukcje%m2% do instalatora. %m3%Przetestuj%m4% swój skrypt zanim go wyślesz",
	"GS_STR_MOD_DOWNLOADSIZE" => "Wielkość ściąganych plików",
	"GS_STR_MOD_TYPE" => "Typ moda",
	"GS_STR_MOD_TYPE0" => "Rozszerzenie gry",
	"GS_STR_MOD_TYPE0_DESC" => "samodzielna paczka która podmienia oryginalne pliki gry",
	"GS_STR_MOD_TYPE1" => "Zbiór addonów",
	"GS_STR_MOD_TYPE1_DESC" => "nowe addony bez zmieniania plików gry",
	"GS_STR_MOD_TYPE2" => "Uzupełnienie",
	"GS_STR_MOD_TYPE2_DESC" => "rozszerza inny mod",
	"GS_STR_MOD_TYPE3" => "Zbiór misji",
	"GS_STR_MOD_TYPE3_DESC" => "zawiera tyko misje",
	"GS_STR_MOD_TYPE4" => "Narzędzia",
	"GS_STR_MOD_TYPE4_DESC" => "Skrypty do tworzenia misji",
	"GS_STR_MOD_ALIAS" => "Inne nazwy moda",
	"GS_STR_MOD_ALIAS_DESC" => "Działa tak samo jak komenda %m1%Alias%m2% ale dla całej instalacji",
	"GS_STR_MOD_MPCOMP" => "Zgodność z grą sieciową",
	"GS_STR_MOD_MPCOMP_HINT" => "Mody tylko do gry jednoosobowej nie bedą pokazywane na liście dodawania modów do serwera",
	"GS_STR_MOD_MPCOMP_YES" => "Tak",
	"GS_STR_MOD_MPCOMP_NO" => "Nie",
	"GS_STR_MOD_SUBMIT" => "Zmień szczegóły",
	"GS_STR_MOD_REQ_VERSION" => "Wymagana wersja gry",
	"GS_STR_MOD_WARNING_LINK" => "Adres do %m1% musi zostać skonwertowany. Użyj opcji \"Skonwertuj link do pliku\" poniżej",

	#Convert download link modal
	"GS_STR_MOD_CONVERTLINK" => "Skonwertuj link do pliku",
	"GS_STR_MOD_CONVERTLINK_DESC" => "Skonwertuj link (z jednej z witryn podanych poniżej) na format zgodny z instalatorem",
	"GS_STR_MOD_CONVERTLINK_SHAREABLE" => "link udostępnienia",
	"GS_STR_MOD_CONVERTLINK_PAGE" => "adres do strony z pobraniem",
	"GS_STR_MOD_CONVERTLINK_FILENAME" => "Nazwa pliku",
	"GS_STR_MOD_CONVERTLINK_BIGFILE" => "Wymaga potwierdzenia",
	"GS_STR_MOD_CONVERTLINK_BIGFILE_DESC" => "(zazwyczaj dla plików powyżej 100 MB, %m1%sprawdź%m2%)",
	"GS_STR_MOD_CONVERTLINK_INSERT" => "Wstaw",
	
	#Edit mod details page feedback
	"GS_STR_MOD_ADDED" => "Wpis moda został dodany",
	"GS_STR_MOD_UPDATED" => "Wpis moda został zaktualizowany",
	"GS_STR_MOD_NOPERM_ERROR" => "Nie masz pozwolenia na zmienianie tego wpisu moda",
	"GS_STR_MOD_MAX_ERROR" => "Nie można przekroczyć dozwolonej liczby wpisów modów",
	"GS_STR_MOD_REMOVED_ERROR" => "Wpis moda został usunięty",
	"GS_STR_MOD_NAME_ERROR" => "Nazwa jest niepoprawna w systemie Windows",
	"GS_STR_MOD_ADDED_ERROR" => "Nie udało się dodać nowego wpisu moda",
	"GS_STR_MOD_UPDATED_ERROR" => "Nie udało się zaktualizować wpisu moda",
	
	#Display mod info page
	"GS_STR_MOD_CURATOR" => "Kustosz",
	"GS_STR_MOD_MANAGED_BY_SINCE" => "Zarządzany przez %m1% od %m2%",
	"GS_STR_MOD_PREVIEW_INSTSCRIPT" => "Podgląd %m1%skryptów instalacyjnych%m2%:",
	"GS_STR_MOD_SHOW_INSTSCRIPT" => "%m1%Pokaż%m2% szczegóły instalacji",
	"GS_STR_MOD_HOWTO_INSTALL" => "Jak zainstalować",

	#Add/Edit mod version section
	"GS_STR_MOD_UPDATE_PAGE_TITLE" => "Instalacja moda %m1%",
	"GS_STR_MOD_SECTION_VERSION" => "Wersje",
	"GS_STR_MOD_SELECT_VER" => "Wybierz wersję",
	"GS_STR_MOD_ADD_NEW_VER" => "Dodaj nową wersję",
	"GS_STR_MOD_NEW_NUM" => "Nowy numer",
	"GS_STR_MOD_NEW_NUM_HINT" => "Numer wersji moda po tej aktualizacji",
	"GS_STR_MOD_ADD_NEW_SCRIPT" => "Dodaj nowy skrypt",
	"GS_STR_MOD_SAME_AS" => "Taki sam jak w wersji",
	"GS_STR_MOD_AND" => "i",
	"GS_STR_MOD_X_OTHERS" => "%m1% inn%m2%",
	"GS_STR_MOD_PATCHNOTES" => "Opis zmian",
	"GS_STR_MOD_PATCHNOTES_HINT" => "Co się zmieniło w tej aktualizacji?",
	"GS_STR_MOD_PATCHNOTES_EXAMPLE" => "dodano nową jednostkę",
	"GS_STR_MOD_PREVIEW_INST" => "Podgląd instalacji",
	"GS_STR_MOD_SECTION_VERSION_SUBMIT" => "Dodaj nową wersję",
	"GS_STR_MOD_SECTION_VERSION_EDIT_SUBMIT" => "Edytuj wersję",

    #Add/Edit mod version section feedback
	"GS_STR_MOD_VERSION_ADDED" => "Wersja dodana",
	"GS_STR_MOD_SCRIPT_ADDED" => "Skrypt dodany",
	"GS_STR_MOD_RECENTVER_ERROR" => "Nie udało się znaleźć najnowszej wersji tego moda",
	"GS_STR_MOD_SCRIPT_ADDED_ERROR" => "Nie udało się dodać nowego skryptu",
	"GS_STR_MOD_VERSION_ADDED_ERROR" => "Nie udało się dodać nowej wersji",
	"GS_STR_MOD_VERSION_UPDATED" => "Wersja zmieniona",
	"GS_STR_MOD_VERSION_DELETED" => "Wersję usunięto",
	"GS_STR_MOD_VERSION_UPDATED_ERROR" => "Nie udało się zmienić wersji",
	"GS_STR_MOD_VERSION_DELETED_ERROR" => "Nie udało się usunąć wersji",
	"GS_STR_MOD_VERSION_DELETEBASE_ERROR" => "Nie można usunąć pierwszej wersji moda",
	"GS_STR_MOD_SCRIPT_UPDATED" => "Skrypt zmieniony",
	"GS_STR_MOD_SCRIPT_UPDATED_ERROR" => "Nie udało się zmienić skryptu",
    
    #Jump between mod versions section
	"GS_STR_MOD_SECTION_JUMP" => "Przeskoczenie wersji",
	"GS_STR_MOD_LINK" => "Wybierz skok",
	"GS_STR_MOD_ADD_NEW_LINK" => "Dodaj nowy skok",
	"GS_STR_MOD_TO" => "do",
	"GS_STR_MOD_NEWEST" => "najnowszej",
	"GS_STR_MOD_LINK_FROM" => "Z wersji",
	"GS_STR_MOD_LINK_FROM_HINT" => "Warunek skoku",
	"GS_STR_MOD_LINK_TO" => "Do wersji",
	"GS_STR_MOD_LINK_TO_HINT" => "Rezultat skoku",
	"GS_STR_MOD_LINK_TO_NEWEST" => "Zawsze do najnowszej",
	"GS_STR_MOD_LINK_REMOVE" => "Usuń wybrany skok",
	"GS_STR_MOD_SECTION_JUMP_SUBMIT" => "Dodaj nowy skok",
	"GS_STR_MOD_SECTION_JUMP_EDIT_SUBMIT" => "Zmień skok",

    #Jump between mod versions section feedback    
	"GS_STR_MOD_LINK_ADDED" => "Skok dodany",
	"GS_STR_MOD_LINK_UPDATED" => "Skok zaktualizowany",
	"GS_STR_MOD_LINK_DELETED" => "Skok usunięty",
	"GS_STR_MOD_CONDITION_ERROR" => "Błąd warunku",
	"GS_STR_MOD_LINKVER_ERROR" => "Nie udało się znaleźć wybranej wersji moda",
	"GS_STR_MOD_LINK_ADDED_ERROR" => "Nie udało się dodać nowego skoku",
	"GS_STR_MOD_LINK_UPDATED_ERROR" => "Nie udało się zmienić skoku",
	"GS_STR_MOD_LINK_DELETED_ERROR" => "Nie udało się usunąć skoku",
	"GS_STR_MOD_LINK_INVALID_ERROR" => "Niepoprawny skok",
	
	#Installation scripts FAQ
	"GS_STR_MOD_FAQ_HOWTOWRITE" => "Jak napisać skrypt?",
	"GS_STR_MOD_FAQ_PAR1" => "Wklej link do pliku a instalator zainstaluje go automatycznie. Możliwe jest, że trzeba będzie ten odsyłacz najpierw skonwertować.",
	"GS_STR_MOD_FAQ_CONVERT_Q1" => "Dlaczego linki muszą być konwertowane?",
	"GS_STR_MOD_FAQ_CONVERT_A1" => "Instalator potrzebuje bezpośredniego linku do pliku. Jeśli plik znajduje się w Google Drive, Mod DB, Mediafire lub innym to wtedy musisz wpisać dodatkowe informacje, które pozwolą instalatorowi na znalezieniu poprawnego źródła.",
	"GS_STR_MOD_FAQ_CONVERT_Q2" => "Jak mogę skonwertować link?",
	"GS_STR_MOD_FAQ_CONVERT_A2" => "Poniżej znajduje sie przycisk \"Skonwertuj link do pliku\". Naciśnij na niego i wklej odsyłacz do pola wpisywania.",
	"GS_STR_MOD_FAQ_LINKS_Q" => "Chcę wiedzieć więcej o linkach",
	"GS_STR_MOD_FAQ_LINKS_A1" => "Jedna linijka, jeden link. Odstępy powinny być zamienione na %20. Umieść linki do tego samego pliku w nawiasach klamrowych.",
	"GS_STR_MOD_FAQ_LINKS_A2" => "Przeczytaj więcej o formacie linków",
	"GS_STR_MOD_FAQ_AUTO_Q" => "Jak działa automatyczna instalacja?",
	"GS_STR_MOD_FAQ_AUTO_A" => "Instalator ściąga plik, wypakowuje go i przenosi pliki do folderu z grą.",
	"GS_STR_MOD_FAQ_AUTO_A2" => "Chcę znać dokładne zasady",
	"GS_STR_MOD_FAQ_MANUAL_Q" => "Jak mogę kierować procesem instalacji?",
	"GS_STR_MOD_FAQ_MANUAL_A" => "Używając komend. Na przykład: \"unpack\" and \"move\". Jedna linijka, jedna komenda.",
	"GS_STR_MOD_FAQ_UNPACK_A1" => "Napisz \"unpack url\" aby ściągnąć i rozpakować plik do tymczasowego katalogu.",
	"GS_STR_MOD_FAQ_UNPACK_A2" => "Przeczytaj więcej o \"unpack\"",
	"GS_STR_MOD_FAQ_MOVE_A1" => "Napisz \"move filename\" aby przenieść rozpakowany plik do katalogu z modem.",
	"GS_STR_MOD_FAQ_MOVE_A2" => "Przeczytaj więcej o \"move\"",
	"GS_STR_MOD_FAQ_MANUAL_Q2" => "Jakie są jeszcze inne komendy?",
	"GS_STR_MOD_FAQ_MANUAL_A2" => "Można wypakowywać i tworzyć pliki PBO, edytować tekst, usuwać i zmieniać nazwy plików, tworzyć foldery.",
	"GS_STR_MOD_FAQ_MANUAL_A3" => "Chcę poznać wszystkie komendy",
	"GS_STR_MOD_FAQ_MISSION_Q" => "Gdzie umieścić misje?",
	"GS_STR_MOD_FAQ_MISSION_A1" => "Przenieś je do folderu \"Missions\" lub \"MPMissions\" w katalogu z modem.",
	"GS_STR_MOD_FAQ_MISSION_A2" => "Przeczytaj więcej o folderach misji",
	"GS_STR_MOD_FAQ_DTA_Q" => "Jak mogę zamienić oryginalne tekstury/modele?",
	"GS_STR_MOD_FAQ_DTA_A1" => "Skorzystaj z poniższego szablonu:",
	"GS_STR_MOD_FAQ_DTA_A2" => "Chcę zobaczyć przykład z komentarzem",
	"GS_STR_MOD_FAQ_TEST_Q" => "Jak mogę przetestować skrypt instalacyjny?",
	
    #Share server page
	"GS_STR_SERVER_SHARESERVER_PAGE_TITLE" => "Współdzielenie serwera %m1%",
	"GS_STR_SERVER_SHAREMOD_PAGE_TITLE" => "Współdzielenie moda %m1%",
	"GS_STR_SHARE_PERMISSIONS" => "Uprawnienia",
	"GS_STR_SHARE_EDIT" => "Zmiana szczegółów",
	"GS_STR_SHARE_SCHEDULE" => "Zmiana harmonogramu",
	"GS_STR_SHARE_MODS" => "Zmiana modów",
	"GS_STR_SHARE_SHARE" => "Zmiana partnerów",
	"GS_STR_SHARE_DELETE" => "Usuwanie",
	"GS_STR_SHARE_INSTALLATION" => "Zmiana instalacji",
	"GS_STR_SHARE_UPDATE" => "Aktualizowanie",
	"GS_STR_SHARE_TRANSFER" => "Zmień właściciela",
	"GS_STR_SHARE_TRANSFER_HINT" => "Żeby zmienić właściciela odznacz pozostałe opcje",
	"GS_STR_SHARE_TRANSFER_CONFIRM_SERVER" => "Stracisz dostęp do tego serwera. Na pewno?",
	"GS_STR_SHARE_TRANSFER_CONFIRM_MOD" => "Stracisz dostęp do tego moda. Na pewno?",
	"GS_STR_SHARE_GRANT" => "Przyznaj",
	"GS_STR_SHARE_CONTRIBUTORS" => "Obecni partnerzy",
	"GS_STR_SHARE_REVOKE" => "Unieważnij zaznaczonych",

    #Share server/mod page feedback
	"GS_STR_SHARE_GRANTED" => "Użytkownik %m1% otrzymał dostęp",
	"GS_STR_SHARE_UPDATED" => "Uprawnienia zaktualizowane",
	"GS_STR_SHARE_REMOVED" => "Dostęp unieważniony dla %m1% użytkownik%m2%",
	"GS_STR_SHARE_REMOVED_ERROR" => "Nie udało się unieważnić dostępu",
	"GS_STR_SHARE_FIND_USERS_ERROR" => "Nie udało się znaleźć użytkowników",
	"GS_STR_SHARE_FIND_USER_ERROR" => "Nie udało się znaleźć tego użytkownika",
	"GS_STR_SHARE_NOSEL_ERROR" => "Nie wybrano użytkownika",
	"GS_STR_SHARE_ALREADY_ERROR" => "już ma dostęp",
	"GS_STR_SHARE_GRANTED_ERROR" => "Nie udało się udzielić dostępu",
	"GS_STR_SHARE_UPDATED_ERROR" => "Nie udało się zmienić pozwoleń",
	"GS_STR_SHARE_LIMIT_ERROR" => "Nie można przekroczyć dozwolonej liczby współpracowników",
	"GS_STR_SHARE_NOTOWNER_ERROR" => "Nie jesteś właścicielem tego serwera",
	
	#Delete page
	"GS_STR_DELETE_PAGE_TITLE" => "Usuń %m1% %m2%",
	"GS_STR_DELETE_MOD_USED" => "Ten mod jest używany przez %m1% serwer%m2%",
	"GS_STR_DELETE_MOD_SURE" => "Na pewno?",
	"GS_STR_DELETE_GOBACK" => "Powrót",
	"GS_STR_DELETE_DONE" => "%m1% usunięto",
	"GS_STR_DELETE_DONE_ERROR" => "Nie udało się usunąć %m1%",
	
	#Activity log
	"GS_STR_LOG_SERVER_ADDED" => "%m1% dodał nowy serwer %m2%",
	"GS_STR_LOG_SERVER_UPDATED" => "%m1% zmienił serwer %m2%",
	"GS_STR_LOG_SERVER_EVENT_REMOVED" => "%m1% usunął/usunęłą sesję %m2% z serwera %m3%",
	"GS_STR_LOG_SERVER_EVENT_UPDATE" => "%m1% zmienił(a) sesję %m2% na serwerze %m3%",
	"GS_STR_LOG_SERVER_EVENT_ADDED" => "%m1% dodał(a) nową sesję %m2% do serwera %m3%",
	"GS_STR_LOG_SERVER_MOD_REMOVED" => "%m1% usunął/usunęłą mod %m2% z serwera %m3%",
	"GS_STR_LOG_SERVER_MOD_ADDED" => "%m1% dodał(a) mod %m2% do serwera %m3%",
	"GS_STR_LOG_SERVER_MOD_CHANGED" => "%m1% zmienił(a) mody na serwerze %m3%",
	"GS_STR_LOG_SERVER_REVOKE_ACCESS" => "%m1% unieważnił(a) dostęp do serwera %m2% dla %m3%",
	"GS_STR_LOG_MOD_REVOKE_ACCESS" => "%m1% unieważnił(a) dostęp do moda %m2% dla %m3%",
	"GS_STR_LOG_SERVER_SHARE_ACCESS" => "%m1% udzielił(a) dostępu do serwera %m2% dla %m3%",
	"GS_STR_LOG_MOD_SHARE_ACCESS" => "%m1% udzielił(a) dostępu do moda %m2% dla %m3%",
	"GS_STR_LOG_SERVER_TRANSFER_ADMIN" => "%m1% oddał(a) serwer %m2% dla %m3%",
	"GS_STR_LOG_MOD_TRANSFER_ADMIN" => "%m1% oddał(a) mod %m2% dla %m3%",
	"GS_STR_LOG_SERVER_DELETE" => "%m1% usunął/usunęłą serwer %m2%",
	"GS_STR_LOG_MOD_DELETE" => "%m1% usunął/usunęłą mod %m2%",
	"GS_STR_LOG_MOD_ADDED" => "%m1% dodał(a) nowy mod %m2%",
	"GS_STR_LOG_MOD_UPDATED" => "%m1% zmienił(a) mod %m2%",
	"GS_STR_LOG_MOD_SCRIPT_UPDATED" => "%m1% zmienił(a) skrypt instalacyjny %m2%",
	"GS_STR_LOG_MOD_SCRIPT_ADDED" => "%m1% dodał(a) nowy skrypt instalacyjny %m2%",
	"GS_STR_LOG_MOD_VERSION_ADDED" => "%m1% zaktualizował(a) mod %m2% do wersji %m3%",
	"GS_STR_LOG_MOD_VERSION_UPDATED" => "%m1% zmienił(a) wersję %m3% modu %m2%",
	"GS_STR_LOG_MOD_LINK_ADDED" => "%m1% dodał(a) nowy skok wersji %m2%",
	"GS_STR_LOG_MOD_LINK_UPDATED" => "%m1% zmienił(a) skok wersji %m2%",
	"GS_STR_LOG_MOD_LINK_DELETED" => "%m1% usunął/usunęłą skok wersji %m2%",
    "GS_STR_LOG_INSTALLER_UPDATED" => "Zaktualizowano %m1%język skryptowy instalacji modów%m2% do wersji %m3%"
));
?>