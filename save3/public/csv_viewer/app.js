var input = document.getElementById('input-file')
var handsontableContainer = document.getElementById('handsontable-container')

input.onchange = function () {
  var file = this.files[0]
  var reader = new FileReader()

  reader.onload = function (e) {
    var csv = e.target.result
    var data = Papa.parse(csv, {
      header: true,
      skipEmptyLines: true
    })

    // reset container
    handsontableContainer.innerHTML = ''
    handsontableContainer.className = ''
    document.querySelector('input').remove()
    document.querySelector('.btn-1').remove()
    document.querySelector('.place-your-ad-here').remove()

    Handsontable(handsontableContainer, {
      data: data.data,
      rowHeaders: true,
      colHeaders: data.meta.fields,
      columnSorting: true,
      width: '100%',
      licenseKey: 'non-commercial-and-evaluation',
    })
  }

  file && reader.readAsText(file)
}
