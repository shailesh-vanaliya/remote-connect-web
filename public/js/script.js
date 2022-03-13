// TODO: Update with serialNumbers from your own NFC tags: https://googlechrome.github.io/samples/web-nfc/
const tagsColors = {
  "04:08:4c:0a:bb:5d:81": "red",
  // "04:60:73:0a:bb:5d:80": "forestgreen",
  // "04:68:6d:0a:bb:5d:81": "dodgerblue",
  // "04:48:4c:0a:bb:5d:80": "slategray",
  // "04:6c:8e:0a:bb:5d:80": "gold",
  // "04:fa:3a:0a:bb:5d:80": "mediumorchid"
};

let numberOfTimesUserWon = 0;

let serialNumbers = [];

const cards = Array.from(document.getElementById("cards").children);

const LOST_IMAGE_URL =
  "https://cdn.glitch.com/a26fc0a9-d6cf-4b67-9100-2227eedddb62%2Floudly-crying-face.png?v=1573121443006";
const WIN_IMAGE_URL =
  "https://cdn.glitch.com/a26fc0a9-d6cf-4b67-9100-2227eedddb62%2Fface-with-party-horn-and-party-hat.png?v=1573121623577";

const TEST_IMAGE_URL = "https://innovegicsolutions.in/images/logo.png";
let reader;

function onreading({ serialNumber }) {
  // User tapped wrong tag.
  if (
    serialNumbers.includes(serialNumber) &&
    serialNumber !== serialNumbers.shift()
  ) {
    lost();
    return;
  }

  // User tapped all tags in the right order.
  if (serialNumbers.length === 0) {
    win();
    return;
  }

  // Show tag color user tapped.
  setColor(serialNumber);
}

button.onclick = async () => {
  // Start NFC scanning and prompt user if needed.
  reader = new NDEFReader();
  await reader.scan();
  reset();

  // Create random sequence of tag serial numbers.
  const allSerialNumbers = Object.keys(tagsColors);
  serialNumbers = [];
  while (allSerialNumbers.length) {
    const randomIndex = Math.floor(Math.random() * allSerialNumbers.length);
    serialNumbers = serialNumbers.concat(
      allSerialNumbers.splice(randomIndex, 1)
    );
  }

  // Show colors to memorize.
  for (const serialNumber of serialNumbers) {
    await setColor(serialNumber, true /* transient */);
  }

  // Start listening to tags.
  reader.onreading = onreading;
};

function reset() {
  reader.onreading = null;
  cards.forEach(card => {
    card.style.backgroundColor = "";
    card.style.backgroundImage = "";
  });
  button.classList.toggle("hidden", true);
}

function lost() {
  reset();
  cards.forEach(card => {
    card.style.backgroundImage = `url(${LOST_IMAGE_URL})`;
  });
  button.classList.toggle("hidden", false);
  numberOfTimesUserWon = 0;
}

function win() {
  reset();
  cards.forEach(card => {
    card.style.backgroundImage = `url(${WIN_IMAGE_URL})`;
  });
  button.classList.toggle("hidden", false);
  numberOfTimesUserWon++;
}

async function setColor(serialNumber, transient = false) {
  const color = tagsColors[serialNumber];
  const card = cards[Object.values(tagsColors).indexOf(color)];
  // card.style.backgroundColor = color;
  card.style.backgroundImage = `url(${TEST_IMAGE_URL})`;
  if (transient) {
    await new Promise(resolve => {
      setTimeout(_ => {
        resolve();
        // card.style.backgroundColor = "";
        card.style.backgroundImage = "";
      }, Math.max(100, 500 - 200 * numberOfTimesUserWon));
    });
  }
}
