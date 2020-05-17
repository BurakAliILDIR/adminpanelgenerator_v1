const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http);

app.get('/', (req, res) => {
  res.send('Burası anasayfa');
});

http.listen(3007, () => {
  console.log('Server çalışıyor.');
});
