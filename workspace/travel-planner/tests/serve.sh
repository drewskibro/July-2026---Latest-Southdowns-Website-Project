#!/usr/bin/env bash
# The harness server: PHP's built-in server over harness/, the plugin at /plugin/ and the theme at /theme/.
#   ./serve.sh            start it if nothing answers on the port
#   GTP_PORT=8912 ...     another port
cd "$(dirname "$0")/harness" || exit 2
PORT="${GTP_PORT:-8911}"
if curl -s --noproxy '*' --max-time 2 "http://127.0.0.1:$PORT/ctl.php" 2>/dev/null | grep -q '"world"'; then echo "harness already on $PORT"; exit 0; fi
nohup php -d opcache.enable=0 -S "127.0.0.1:$PORT" router.php > ../php.log 2>&1 &
for i in 1 2 3 4 5 6 7 8 9 10; do curl -s --noproxy '*' --max-time 2 "http://127.0.0.1:$PORT/ctl.php" 2>/dev/null | grep -q '"world"' && { echo "harness on $PORT"; exit 0; }; sleep 0.3; done
echo "harness did not start; see php.log"; exit 1
