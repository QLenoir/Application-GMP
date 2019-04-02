Application Web pour le département GMP pour la création de sujets personnalisés


# Pour configurer un serveur SMTP avec WAMPServeur

- Dézipper le fichier 'sendmail.zip' dans "C:\wamp64\serveur_mail"
- Modifier le fichier 'sendmail.ini' pour chaque ligne précisée ci-dessous :
> Le mail à utiliser pour Intera Notes :  
> Mail : developpement_web@laposte.net | Mot de passe : @developpementWeb87

```shell
smtp_server=LE_SERVEUR_SMTP
;exemple : smtp.laposte.net / smtp.gmail.com

; smtp port (normally 25)

smtp_port=465

smtp_ssl=ssl

default_domain=localhost

auth_username=MAIL_D_ENVOI
auth_password=MOT_DE_PASSE

force_sender=MAIL_D_ENVOI
```

- Modifier le fichier 'C:\wamp64\bin\apache\apache2.4.27\bin\php' pour la partie [mail function] (_garre aux points virgules !_):
```shell
[mail function]
; For Win32 only.
; http://php.net/smtp
;SMTP = localhost
; http://php.net/smtp-port
;smtp_port = 25

; For Win32 only.
; http://php.net/sendmail-from
;sendmail_from ="admin@wampserver.invalid"

; For Unix only.  You may supply arguments as well (default: "sendmail -t -i").
; http://php.net/sendmail-path
sendmail_path = "C:\wamp64\serveur_mail\sendmail.exe"
```
- Activer l'extension Apache 'ssl_module'
- Activer les extensions PHP 'php_openssl' et 'php_sockets'
- Redémarrer les services de WAMP

# Pour configurer un serveur SMTP sur un serveur Linux

- Installer le paquet 'msmtp' :
```shell
apt-get install msmtp
```

- Créer un fichier de conf pour msmtp :
```shell
mkdir /var/www/apache2-default
cd /var/www/apache2-default
nano .msmtprc
```
- Editer sa configuration :
```shell
# Set default values for all following accounts.
defaults
auth           on
tls            on
tls_trust_file /etc/ssl/certs/ca-certificates.crt
logfile        ~/.msmtp.log

# Gmail
account        gmail
host           smtp.gmail.com
port           587
from           username@gmail.com
user           username
password       passwordUser

# A freemail service
account        freemail
host           smtp.freemail.example
port           587
from           username@gmail.com
user           username
password       passwordUser

# Set a default account
account default : gmail
```

- S'assurer que seul l'utilisateur Apache a les droits sur la conf :
```shell
chown www-data:www-data .msmtprc
chmod 600 .msmtprc
```

- Modifier sendmail_path dans php.ini en lui indiquant quel fichier de conf utiliser :
```shell
nano /etc/php/7.2/apache2/php.ini
sendmail_path = "/usr/bin/msmtp -t -C /var/www/apache2-default/.msmtprc"
```
- Redémarrer apache :
```shell
systemctl restart apache2
```

- En cas de besoin, les logs apache :
```shell
cat /var/log/apache2/error.log
```

## Ressources utilisées pour la configuration SMTP sur le serveur Linux :
- https://doc.ubuntu-fr.org/tutoriel/comment_envoyer_un_mail_par_smtp_en_ligne_de_commande#utilisation_de_msmtp
- https://wiki.archlinux.org/index.php/msmtp#Installing
- https://wiki.archlinux.org/index.php/msmtp#Send_mail_with_PHP_using_msmtp
- https://marcarea.com/weblog/2008/02/12/envoyer-des-emails-avec-gmail-via-php-et-msmtp-ubuntu
