const btnAdd = document.querySelector('#btn-add')
const tabla = document.querySelector('#ingredientes')


btnAdd.addEventListener('click', (e) => {
  addColumn(e)
})

function addColumn(e) {
  e.preventDefault()
  let fila = document.createElement('tr')

  let columnas = `<td><input name='ing[${tabla.rows.length++}][cantidad]'  type='text' placeholder='cantidad'></td><td><input name='ing[${tabla.rows.length++}][tipoCant]' type='text' placeholder='unidad de medida'></td><td><input name='ing[${tabla.rows.length++}][nombre]' type='text' placeholder='ingrediente'></td>`
  fila.innerHTML = columnas

  let newCol = document.createElement('td')
  let newBtnAdd = document.createElement('button')
  newBtnAdd.addEventListener('click', addColumn)
  newBtnAdd.classList.add('btn', 'btn-info')
  newBtnAdd.textContent = "Sumar"
  newCol.appendChild(newBtnAdd)
  fila.appendChild(newCol)
  //TODO: añadir boton de eliminar a las columnas
  tabla.appendChild(fila)
}


const btnAddPasos = document.querySelector('#btn-add-paso')
const tablaPasos = document.querySelector('#pasos')


btnAddPasos.addEventListener('click', (e) => {
  addColumnPasos(e)
})

function addColumnPasos(e) {
  e.preventDefault()
  let fila = document.createElement('tr')

  let columnas = `
  <tr>
                        <td>
                            <textarea  name="paso[${tablaPasos.rows.length++}][secuencia]" id="" cols="60" rows="5"></textarea>
                            <input type="hidden" name="paso[${tablaPasos.rows.length++}][orden]" value="${tablaPasos.rows.length+1}">
                        </td>
                        <td>
                            <input name="paso[${tablaPasos.rows.length++}][imagen]" class="form-control" type="file"id="">
                        </td>
                    </tr>
  `
  fila.innerHTML = columnas

  let newCol = document.createElement('td')
  let newBtnAdd = document.createElement('button')
  newBtnAdd.addEventListener('click', addColumnPasos)
  newBtnAdd.classList.add('btn', 'btn-info')
  newBtnAdd.textContent = "Sumar"
  newCol.appendChild(newBtnAdd)
  fila.appendChild(newCol)
  //TODO: añadir boton de eliminar a las columnas
  tablaPasos.appendChild(fila)
}