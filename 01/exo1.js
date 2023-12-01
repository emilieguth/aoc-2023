import * as fs from "fs";
import * as readline from "readline";

const readInterface = readline.createInterface({
  input: fs.createReadStream('input-exo.txt'),
  console: false
});

let values = 0;
const pattern = /(\d)/g
readInterface.on('line', function(line) {
  console.log(line);
  const allMatches = Array.from(line.matchAll(pattern));
  console.log(allMatches[0][1], allMatches[0][2]);
  const val = Number(`${allMatches[0][1] ?? allMatches[0][2]}${allMatches[0][2]}`);
  console.log(val);
  values += val;
  /*const matches = allMatches.map((match) => {
    const [value] = match;
    if (value.length > 0) {
      return Number(value);
    }
    return null;
  }).filter((value) => !!value);
  if (matches.length === 1) {
    console.log(Number(`${matches[0]}${matches[0]}`));
    values += (Number(`${matches[0]}${matches[0]}`));
  }
  if (matches.length > 1) {
    console.log(Number(`${matches[0]}${matches[matches.length - 1]}`));
    values += (Number(`${matches[0]}${matches[matches.length - 1]}`));
  }*/
});

readInterface.on('close', function() {
  console.log(values);
  console.log('Finished reading the file.');
});
