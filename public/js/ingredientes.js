const btnAdd = document.querySelector('#btn-add')
const tabla = document.querySelector('#ingredientes')


btnAdd.addEventListener('click', (e) => {
  addColumn(e)
})

function addColumn(e) {
  e.preventDefault()
  let fila = document.createElement('tr')
  fila.id = `ing-${tabla.rows.length++}`

  let columnas = `<td><input type="checkbox" name="" id="" value="ing-${tabla.rows.length++}"></td><td><input name='ing[${tabla.rows.length++}][cantidad]'  type='text' placeholder='cantidad'></td><td><input name='ing[${tabla.rows.length++}][tipoCant]' type='text' placeholder='unidad de medida'></td><td><input name='ing[${tabla.rows.length++}][nombre]' type='text' placeholder='ingrediente'></td>`
  fila.innerHTML = columnas

  tabla.appendChild(fila)
}

function delRow(e, fila) {
  e.preventDefault()

  fila.remove()

}


const btnAddPasos = document.querySelector('#btn-add-paso')
const tablaPasos = document.querySelector('#pasos')


btnAddPasos.addEventListener('click', (e) => {
  addColumnPasos(e)
})

function addColumnPasos(e) {
  e.preventDefault()
  let fila = document.createElement('tr')
  fila.id = `pas-${tablaPasos.rows.length++}`

  let columnas = `
                    <tr>                  
                        <td>
                            <input type="checkbox" name="" id="" value="pas-${tablaPasos.rows.length++}">

                        </td>
                        <td>
                            <textarea  name="paso[${tablaPasos.rows.length++}][secuencia]" id="" cols="60" rows="5"></textarea>
                            <input type="hidden" name="paso[${tablaPasos.rows.length++}][orden]" value="${tablaPasos.rows.length + 1}">
                        </td>
                        <td>
                            <input name="paso[${tablaPasos.rows.length++}][imagen]" class="form-control" type="file"id="">
                        </td>
                    </tr>
  `
  fila.innerHTML = columnas

  tablaPasos.appendChild(fila)
}

const btDeleteIng = document.querySelector('#btn-delete-ing')
const btDeletePas = document.querySelector('#btn-delete-pas')

btDeleteIng.addEventListener('click', (e) => {
  e.preventDefault()
  let noneChecked = true // controll if there's some input checked

  let elegidos = document.querySelectorAll('#ingredientes input[type=checkbox]')

  elegidos.forEach((elegido) => {
    if (elegido.checked) {
      noneChecked = false
      let fila = document.querySelector(`#${elegido.value}`)
      console.log(elegido.value)
      fila.remove()
    }
  })

  if (noneChecked)
    alert("Selecciona antes uno para eliminar")
})

btDeletePas.addEventListener('click', (e) => {
  e.preventDefault()
  let noneChecked = true // controll if there's some input checked

  let elegidos = document.querySelectorAll('#pasos input[type=checkbox]')

  elegidos.forEach((elegido) => {
    if (elegido.checked) {
      noneChecked = false
      let fila = document.querySelector(`#${elegido.value}`)
      fila.remove()
    }
  })

  if (noneChecked)
    alert("Selecciona antes uno para eliminar")
})