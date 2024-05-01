##oracle
docker pull gvenzl/oracle-xe:21-full

docker run -d -p 1521:1521 -e ORACLE_PASSWORD=SysPassword1 -v oracle-volume:/opt/oracle/XE21CFULL/oradata gvenzl/oracle-xe:21-full

docker rename da37a77bb436 21cFull

sqlplus system/SysPassword1@//localhost/XEPDB1

create user demo identified by demo quota unlimited on users;

grant connect, resource to demo;

connect demo/demo@//localhost/XEPDB1

docker stop 21cFull
docker start 21cFull