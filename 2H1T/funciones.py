def registro():
    nombre = input('Escribe el nombre: ')
    dni = input('Escribe el dni: ')
    tlf = input('Escribe el teléfono: ')
    
    cliente = {
        'nombre' : nombre,
        'dni' : dni,
        'tlf' : tlf,
    }
    return cliente

def existe_en_lista(lista, clave, valor):
    return any(d[clave] == valor for d in lista) #esta función se encarga de buscar si un valor esta dentro de una lista
    