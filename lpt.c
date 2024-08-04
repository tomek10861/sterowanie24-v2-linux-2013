#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/io.h>

#define BASEPORT 0x378

int main(int liczba, char *parametr[]) {
    ioperm(BASEPORT,1,1);
    ioperm(BASEPORT+1,1,1);
    ioperm(BASEPORT+2,1,1);
    int wynik = 2, pos;

    if (liczba==1 || liczba >=4) {
       printf("Blad parametrow\n");
       return 0;
    } else {
       if (liczba==2) {
          wynik = strcmp(parametr[1],"get");
          if (wynik == 0) {
             wynik = inb(BASEPORT);
             printf("%d\n",wynik);
             return 0;
          }
          return 0;
       } else {
          wynik = strcmp(parametr[1],"set");
          if (wynik == 0) {
             wynik = atoi(parametr[2]);
             outb(wynik,BASEPORT);
             return 0;
          }
          wynik = strcmp(parametr[1],"getbit");
          if (wynik == 0) {
             pos = atoi(parametr[2]);
             wynik = inb(BASEPORT);
             wynik = wynik&(1<<pos);
             if(wynik != 0) {
                printf("1\n");
             } else {
                printf("0\n");
             };
             return 0;
          }
          wynik = strcmp(parametr[1],"getsbit");
          if (wynik == 0) {
             pos = atoi(parametr[2]);
             wynik = inb(BASEPORT+1);
             wynik = wynik&(1<<pos);
             if(wynik != 0) {
                printf("1\n");
             } else {
                printf("0\n");
             };
             return 0;
          }
          wynik = strcmp(parametr[1],"getcbit");
          if (wynik == 0) {
             pos = atoi(parametr[2]);
             wynik = inb(BASEPORT+2);
             wynik = wynik&(1<<pos);
             if(wynik != 0) {
                printf("1\n");
             } else {
                printf("0\n");
             };
             return 0;
          }
          wynik = strcmp(parametr[1],"setbit");
          if (wynik == 0) {
             pos = atoi(parametr[2]);
             wynik = inb(BASEPORT);
             wynik = wynik | (1<<pos);
             outb(wynik,BASEPORT);
             return 0;
          }
          wynik = strcmp(parametr[1],"clrbit");
          if (wynik == 0) {
             pos = atoi(parametr[2]);
             wynik = inb(BASEPORT);
             wynik = wynik & ~(1<<pos);
             outb(wynik,BASEPORT);
             return 0;
          }
          wynik = strcmp(parametr[1],"setcbit");
          if (wynik == 0) {
             pos = atoi(parametr[2]);
             wynik = inb(BASEPORT+2);
             wynik = wynik | (1<<pos);
             outb(wynik,BASEPORT+2);
             return 0;
          }
          wynik = strcmp(parametr[1],"clrcbit");
          if (wynik == 0) {
             pos = atoi(parametr[2]);
             wynik = inb(BASEPORT+2);
             wynik = wynik & ~(1<<pos);
             outb(wynik,BASEPORT+2);
             return 0;
          }
          return 0;
       }
    }
}
