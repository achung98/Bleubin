const express = require('express');

const app = express();

app.get('/', (req,res) => {
  res.send("test");
})

app.listen(3000, () => console.log("test"));
