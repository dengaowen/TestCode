### 防火墙设置
    1、开启
        systemctl  start  firewalld.service
    2、关闭
        systemctl  stop  firewalld.service
    3、查看防火墙状态
        firewall-cmd  --state
      
### Nginx
    1、开启
        systemctl start nginx.service
    2、关闭
        systemctl stop nginx.service
   