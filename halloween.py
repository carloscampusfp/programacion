import random
monster_dicc = {"bruja" : "poción", "momia" : "hechizo", "vampiro" : "estaca"}
rounds = 0
round1 = []
round2 = []
round3 = []
def probabilidad (dificultad):
    prob_win = random.randint(1,100)
    if dificultad == 1 and prob_win > 10: #90% de ganar
        return True
    elif dificultad == 2 and prob_win > 20: #80% de ganar
        return True
    elif dificultad == 3 and prob_win > 30: #70% de ganar
        return True
    elif dificultad == 4 and prob_win > 40: #60% de ganar
        return True
    elif dificultad == 5 and prob_win > 50: #50% de ganar
            return True
    else:
         return False

while rounds!=3:
    mons = random.choice(list(monster_dicc.keys())) #escogerá uno de los mountruos
    monster_dif = random.randint(1,5) #escogera la dificultad
    rounds += 1
    dificult = probabilidad(monster_dif)
    print(f"RONDA: {rounds}")
    print(f"{mons} de nivel {monster_dif} ha aparecido!!!")
    for i in monster_dicc.values():
        print(f"-{i}")
    objeto = input("Escribe el objeto que desees utilizar: ").lower()
    if rounds == 1:
        round1.append(mons)
        round1.append(monster_dif)
        round1.append(objeto)
    elif rounds == 2:
        round2.append(mons)
        round2.append(monster_dif)
        round2.append(objeto)
    elif rounds == 3:
        round3.append(mons)
        round3.append(monster_dif)
        round3.append(objeto)
    if objeto == monster_dicc[mons] and dificult == True:
        print(f"Felicidades, has pasado la ronda {rounds}")
    else:
        print(f"Lo siento, no pasaste la ronda {rounds}")
        break
    
print("RESULTADOS POR RONDA")
print(f"RONDA 1: apareció {round1[0]} de nivel {round1[1]} y usaste el objeto {round1[2]}")
if rounds == 2:
    print(f"RONDA 2: apareció {round2[0]} de nivel {round2[1]} y usaste el objeto {round2[2]}")
elif rounds == 3:
    print(f"RONDA 2: apareció {round2[0]} de nivel {round2[1]} y usaste el objeto {round2[2]}")
    print(f"RONDA 3: apareció {round3[0]} de nivel {round3[1]} y usaste el objeto {round3[2]}")



