import './field.css'
import autocomplete from 'autocomplete.js'
import axios from 'axios'

const classPrefix = 'company-field'

const clearbitSource = (query, callback) => {
  axios
    .get(`https://autocomplete.clearbit.com/v1/companies/suggest?query=${query}`)
    .then(({ data }) => {
      const containsQuery = data
        .map(suggestion => suggestion.name.toLowerCase())
        .includes(query.toLowerCase())

      if (!containsQuery) {
        data.push({ name: query })
      }

      callback(data)
    })
}

const bodyEl = document.querySelector('body')
const fieldEls = document.querySelectorAll(`.${classPrefix}`);

[...fieldEls].forEach(fieldEl => {
  const valueEl = fieldEl.querySelector(`.${classPrefix}-value`)
  const inputEl = fieldEl.querySelector(`.${classPrefix}-input`)

  const search = autocomplete(inputEl, {
    appendTo: bodyEl,
    autoselect: true,
    cssClasses: {
      prefix: classPrefix,
      root: `${classPrefix}-autocomplete`,
    },
    hint: false,
  }, [
    {
      source: clearbitSource,
      displayKey: 'name',
      templates: {
        suggestion: function (suggestion) {
          return `
            ${suggestion.logo ? `
              <div class="${classPrefix}-image" 
                   style="background-image: url('${suggestion.logo}')"></div>
            ` : `
              <div class="${classPrefix}-fallback">?</div>
            `}
            <div class="${classPrefix}-label">
              ${suggestion.name}
            </div>
          `
        },
      },
    },
  ])

  search.on('autocomplete:selected', (event, suggestion) => {
    valueEl.value = JSON.stringify(suggestion)
  })

  inputEl.addEventListener('blur', () => {
    if (!inputEl.value) {
      // If falsy/empty, reset the field
      valueEl.value = ''
    } else {
      // Otherwise set to the existing value to avoid confusion
      inputEl.value = JSON.parse(valueEl.value).name || ''
    }
  })
})
