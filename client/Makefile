deploy:
	gulp clean
	gulp build
	tar czf client_upload.tar.gz dist
	scp client_upload.tar.gz root@blog.warphp.com:/www/webroot/yat/client
	rm client_upload.tar.gz
	ssh root@blog.warphp.com
prepare:
	npm install
	bower install

start:
	gulp serve