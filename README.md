# OFP Game Schedule

Website for organizing [Operation Flashpoint](https://en.wikipedia.org/wiki/Operation_Flashpoint:_Cold_War_Crisis) / [ArmA: Cold War Assault](https://store.steampowered.com/app/65790/ARMA_Cold_War_Assault/) multiplayer sessions and mods. Built with [UserSpice](https://userspice.com/) PHP framework. Made by [Faguss](https://ofp-faguss.com). Russian translation by [Mju](https://twitter.com/paumju)

[Live version](https://ofp-faguss.com/schedule/)


## Installation:

Requires PHP 7 and UserSpice 4.4.14

* Install [UserSpice](https://github.com/mudmin/UserSpice4)
* Install [Generated_Form](https://github.com/Faguss/Generated_Form) addon
* Copy [Parsedown.php](https://github.com/erusev/parsedown) to users\classes
* Copy GS files to your UserSpice installation folder.
* Import GS_table_structure.sql


## Permissions

Permissions ID-3 and ID-4 determine how many records a user can add.
Permissions ID-5, ID-6, ID-7 permit access to the stringtable editor (translate.php). Link appears in the navigation menu.