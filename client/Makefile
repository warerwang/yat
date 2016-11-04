deploy:
	gulp clean
	sed -i "" "s/.docker././g" src/app/index.js
	gulp build
	tar czf client_upload.tar.gz dist
	scp -P 1208 client_upload.tar.gz root@blog.warphp.com:/www/webroot/yat/client
	rm client_upload.tar.gz
	git checkout src/app/index.js
	ssh -P 1208 root@blog.warphp.com
prepare:
	npm install
	bower install

start:
	gulp serve