POC of atoum's website.
To run it:

    $ cd Application/Public/
    $ php -S 127.0.0.1:8888 -t . .webserver.php > /dev/null 2>&1 &
    $ open !!2

You will need Hoa, thus:

    $ git clone git@git.hoa-project.net:Central /usr/local/lib/Hoa.central
    $ ln -s /usr/local/lib/Hoa.central /usr/local/lib/Hoa
