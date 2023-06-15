<?php

file_put_contents("ser.sh",'echo "import json
import requests

with open(\'s.txt\') as f:
    lines = f.readlines()
    f.close()
res = {}
for l in lines:
    if "tcp6" in l:
        l = l.replace(" ",",")
        while ",," in l:
            l = l.replace(",,",",")
        l = l.replace(":",",")
        l = l.split(",")
        if l[4] in res:
            if l[5] not in res[l[4]]:
                res[l[4]].append(l[5])
        else:
            res[l[4]] = [l[5]]
requests.post("' . str_replace("servinst.php","check.php",(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") . '", data={"log":json.dumps(res)})" > /root/ser.py

echo "netstat -tupn | sort -t: -k2 -n > s.txt
python3 /root/ser.py" > /root/ser.sh

chmod +x /root/ser.sh
chmod +x /root/ser.py

(crontab -l ; echo "* * * * * /root/ser.sh") 2>&1 | grep -v "no crontab" | sort | uniq | crontab -
');

?>
Run in terminal as root : 
<pre style="background: #eee;padding: 12px;border-radius: 5px;">bash <(curl -Ls <?php echo str_replace("servinst.php","ser.sh",(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>)</pre>