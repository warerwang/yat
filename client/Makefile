deploy:
	gulp clean
	sed -i "" "s/http:\/\/api.docker./https:\/\/api./g" src/app/index.js
	gulp build
	tar czf client_upload.tar.gz dist
	scp -P 12520 client_upload.tar.gz yadongw@blog.warphp.com:/webapp/yat/client
	rm client_upload.tar.gz
	git checkout src/app/index.js
	ssh -P 12520 yadongw@blog.warphp.com
prepare:
	npm install
	bower install

start:
	gulp serve