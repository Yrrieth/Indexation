# Indexation

M2 THYP Techniques informatiques et web

***

Mini moteur de recherche

Créer 3 BDD

bdd : bdd_tiw
```
document (id,  document, titre, description)
1 test.html  titre1   ceci est le descriptif etc1    (java 23  sport 10)
2 toto/test1.html titre2   ceci est le descriptif etc2  (scientifique 5 sport 12)
3 tata/test.html titre3   ceci est le descriptif etc2   (article 3   java 4)
4 titi/test.html

doucement_mot (id_document, id_mot, poids)
1  1  23
1  5  10
2  3  5
2  5  12
3  4  3
3  1  4

mot (id, mot)
1 java
2 programme
3 scientifique
4 article
5 sport
6 java
```
