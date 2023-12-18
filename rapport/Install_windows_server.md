# Gestionnaire windows serveur 

- Installation: 

1. Serveur DHCP
    => 192.168.100.0

    Adress Pool :
    192.168.100.2 => 192.168.100.254

    Exclusions:
    192.168.100.244 => 192.168.100.254

2. Active directory
    ISIMS.PARK
    Comptes : 
    1. User
    2. Modérateur
    3. Admin

3. Serveur DNS
    Donner un nom aux serveurs:
     192.168.100.1

    => Ajout d'un second host afin de rediriger le serveur web: 
    SERV WEB IP : 
    servweb.isims.park
    192.168.100.245

    ALIAS: velo.isims.park 


4. Divers problèmes rencontrés: 
    Problemes lors de l'installation de l'AD notamment carte réseaux interne/externe => configurée sur le wifi 
    PAPY2FAST — Aujourd’hui à 13:45

    Oubli de point de controle => Crash winserv suite à l'installation d'une backup 
    PAPY2FAST — Aujourd’hui à 15:07

    ATTENTION DESACTIVER IPV6 SINON CA BUG
    PAPY2FAST — Aujourd’hui à 15:33
    SEULEMENT ACTIVER CARTE RESEAU NECESSAIRE
