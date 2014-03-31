var tty = require('tty.js');

var app = tty.createServer({
  shell: '3001',
  users: {
    admin: 'la_password'
 },

  "https": {
    "key": "./server.key",
    "cert": "./server.crt"
  },
port: 443
});

app.get('/admin', function(req, res, next) {
  res.send('la_password');
});

app.listen();
