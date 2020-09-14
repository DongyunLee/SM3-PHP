# Docker

```bash
cd /path/to/SM3-PHP
sudo chmod a+x ./scripts/*
```
## 开发环境
1. 通过 *Dockerfile* 构建镜像
```bash
cd /path/to/SM3-PHP
./scripts/build-images.sh
```
2. 通过镜像实例化容器
```bash
cd /path/to/SM3-PHP
./scripts/docker-env-dev.sh
```

### 集成命令
#### 第一次运行
```shell script
cd /path/to/SM3-PHP && sudo chmod a+x ./scripts/* && ./scripts/build-images.sh && ./scripts/docker-env-dev.sh
```

#### 常规启动
```shell script
./scripts/docker-env-dev.sh
```
