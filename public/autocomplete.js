const endpoint = '/all';
const names = [];

fetch(endpoint)
  .then(blob => blob.json()
  .then(data => names.push(...data)));

function findMatches(wordToMatch, names) {
  return names.filter(names => {
    const regex = new RegExp(wordToMatch, 'gi');
    return names.name.match(regex)
  })
}

function displayMatches() {
  const matchArray = findMatches(this.value, names);
  const html = matchArray.map(names => {
    return `
      <li>
        <span class="nameAhead">${names.name}</span>
      </li>
    `;
  }).join('');
  nameList.innerHTML = html;

  // user can click on name 
  if (nameAhead.length > 0) {
    nameList.addEventListener('click', (e) => {
      searchInput.value = e.target.textContent.trim();
      nameList.innerHTML = '';
    })
  }

  // keep list from displaying when input is empty
  if (searchInput.value === '') {
    nameList.innerHTML = '';
  }
}

const searchInput = document.querySelector('#name');
const nameList = document.querySelector('#nameList');
const nameAhead = nameList.children;

searchInput.addEventListener('change', displayMatches);
searchInput.addEventListener('keyup', displayMatches);

