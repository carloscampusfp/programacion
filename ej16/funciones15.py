import mysql.connector as myc
def conectar(nombre):
    conexion = myc.connect(
    host="localhost",
    user="root",
    password="curso",
    database=str(nombre)
    )
    return conexion
