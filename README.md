# MongoDB API Project
BYU IT-350 Databases

### Useful Links
Execute query:
https://www.php.net/manual/en/mongodb-driver-manager.executequery.php

JSON Editor
http://jsoneditoronline.org

### Useful commands
Create roles example:
```
db.createRole
({
	  role: "myRole",
	  privileges: [
	    { resource: { db: "someDB", collection: "someCollection" }, actions: [ "find", "update", "insert", "remove" ] },
	  ],
	  roles: [
	    { role: "readWrite", db: "someDB" }
	  ]
	 },
	 { w: "majority" , wtimeout: 5000 
 })

```

Create user example:
```
db.createUser
({
	user: "myUser",
	pwd: "myPass",
	roles:[{role: "someRole" , db:"someDB"}]
})
```

Insert example:
```
db.blog.insert
([{
	  authors: ['test author 1', 'test author 2','test author 3' ],
	  date: '2019-04-03',
	  contents: ['text1', 'text2', 'text3'],
	  keywords: ['puppy', 'fluffy', 'cute'],
	  related_articles: ['mongodb', 'database', 'NoSQL']
}])
```

Authentication:
```
mongo --port 27017 -u "gabe" -p --authenticationDatabase admin
```


