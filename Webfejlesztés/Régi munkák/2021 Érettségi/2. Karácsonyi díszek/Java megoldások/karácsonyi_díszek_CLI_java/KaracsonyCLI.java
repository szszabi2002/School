import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.PrintStream;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

class NapiBevetel {
    private int nap;

    public int getNap() {
        return nap;
    }

    private int harangKesz;

    public int getHarangKesz() {
        return harangKesz;
    }

    private int harangEladott;

    public int getHarangEladott() {
        return harangEladott;
    }

    private int angyalkaKesz;

    public int getAngyalkaKesz() {
        return angyalkaKesz;
    }

    private int angyalkaEladott;

    public int getAngyalkaEladott() {
        return angyalkaEladott;
    }

    private int fenyofaKesz;

    public int getFenyofaKesz() {
        return fenyofaKesz;
    }

    private int fenyofaEladott;

    public int getFenyofaEladott() {
        return fenyofaEladott;
    }

    public NapiBevetel(String sor) {
        String[] s = sor.split(";");
        nap = Integer.parseInt(s[0]);
        harangKesz = Integer.parseInt(s[1]);
        harangEladott = Integer.parseInt(s[2]);
        angyalkaKesz = Integer.parseInt(s[3]);
        angyalkaEladott = Integer.parseInt(s[4]);
        fenyofaKesz = Integer.parseInt(s[5]);
        fenyofaEladott = Integer.parseInt(s[6]);
    }

    public int napiBevetel() {
        return -(harangEladott * 1000 + angyalkaEladott * 1350 + fenyofaEladott * 1500);
    }
}

class KaracsonyCLI {
    public static void main(String[] args) {
        // 3. feladat
        List<NapiBevetel> napiMunkaLista = new ArrayList<>();
        File inputFile = new File("diszek.txt");
        try (Scanner scanner = new Scanner(inputFile)) {
            while (scanner.hasNextLine()) {
                String aktualisSor = scanner.nextLine();
                NapiBevetel fordulo = new NapiBevetel(aktualisSor);
                napiMunkaLista.add(fordulo);
            }
        } catch (FileNotFoundException exception) {
            System.err.print("Fájl nem található!");
        }

        // 4. feladat
        int sum = 0;
        for (NapiBevetel nap : napiMunkaLista) {
            sum += nap.getAngyalkaKesz() + nap.getFenyofaKesz() + nap.getHarangKesz();
        }
        System.out.println("4.feladat: Összesen " + sum + " dísz készült. \n");

        // 5. feladat
        boolean voltUresNap = false;
        for (NapiBevetel nap : napiMunkaLista) {
            if ((nap.getAngyalkaKesz() + nap.getFenyofaKesz() + nap.getHarangKesz()) == 0) {
                voltUresNap = true;
                break;
            }
        }
        System.out.println("5.feladat: " + (voltUresNap ? "Volt" : "Nem volt") + " olyan nap, amikor egyetlen dísz sem készült. \n");

        // 6. feladat
        System.out.println("6.feladat:");
        Scanner input = new Scanner(System.in);
        int beirtNap = 0;
        while (beirtNap < 1 || beirtNap > 40) {
            System.out.print("Adja meg a keresett napot [1 ... 40]: ");
            beirtNap = Integer.parseInt(input.nextLine());
        }
        int[] darabszamok = new int[3];
        for (NapiBevetel nap : napiMunkaLista) {
            darabszamok[0] += nap.getHarangKesz() + nap.getHarangEladott();
            darabszamok[1] += nap.getAngyalkaKesz() + nap.getAngyalkaEladott();
            darabszamok[2] += nap.getFenyofaKesz() + nap.getFenyofaEladott();
            if (nap.getNap() == beirtNap) {
                break;
            }
        }
        System.out.println("        A(z) " + beirtNap + ". nap végén " + darabszamok[0] + " harang, " + darabszamok[1] + " angyalka és " +
                darabszamok[2] + " fenyőfa maradt készleten. \n");

        // 7. feladat
        int[] eladasok = new int[3];
        for (NapiBevetel nap : napiMunkaLista) {
            eladasok[0] -= nap.getHarangEladott();
            eladasok[1] -= nap.getAngyalkaEladott();
            eladasok[2] -= nap.getFenyofaEladott();
        }
        int max = Integer.max(Integer.max(eladasok[0], eladasok[1]), eladasok[2]);
        System.out.println("7.feladat: Legtöbbet eladott dísz: " + max + " darab");
        if (eladasok[0] == max) {
            System.out.println("      Harang");
        }
        if (eladasok[1] == max) {
            System.out.println("      Angyalka");
        }
        if (eladasok[2] == max) {
            System.out.println("      Fenyőfa");
        }

        // 8.feladat
        try {
            int szamlalo = 0;
            PrintStream fileStream = new PrintStream(new File("bevetel.txt"));
            for (NapiBevetel nap : napiMunkaLista) {
                int bevetel = nap.napiBevetel();
                if (bevetel > 10000) {
                    szamlalo++;
                    fileStream.println(nap.getNap() + ";" + bevetel);
                }
            }
            fileStream.print(szamlalo + " napon volt legalább 10000 Ft bevétel.");
            fileStream.close();
        } catch (IOException e) {
            System.err.println("Fájl létrehozása nem sikerült.");
        }
    }
}
