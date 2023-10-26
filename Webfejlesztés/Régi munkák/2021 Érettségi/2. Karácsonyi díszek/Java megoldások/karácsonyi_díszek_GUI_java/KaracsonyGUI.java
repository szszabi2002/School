import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.GridPane;
import javafx.scene.paint.Color;
import javafx.scene.text.Text;
import javafx.stage.Stage;

public class KaracsonyGUI extends Application {
    int keszletDarabszam = 0;

    public void start(Stage stage) {

        // 10.feladat a.)
        GridPane gyokerPane = new GridPane();
        Text feliratNapSzama = new Text("Nap száma:");
        Text feliratElkeszitett = new Text("Elkészített:");
        Text feliratEladott = new Text("Eladott");
        TextArea outputAblak = new TextArea();
        outputAblak.setEditable(false);

        ComboBox napSzamaComboBox = new ComboBox();
        for (int i = 0; i < 40; i++) {
            napSzamaComboBox.getItems().addAll(i + 1);
        }

        TextField elkeszitettTextField = new TextField("0");
        TextField eladottTextField = new TextField("0");

        Button hozzaadButton = new Button("Hozzáad");

        gyokerPane.add(feliratNapSzama, 0, 0);
        gyokerPane.add(napSzamaComboBox, 1, 0);
        gyokerPane.add(feliratElkeszitett, 2, 0);
        gyokerPane.add(elkeszitettTextField, 3, 0);
        gyokerPane.add(feliratEladott, 4, 0);
        gyokerPane.add(eladottTextField, 5, 0);
        gyokerPane.add(hozzaadButton, 6, 0);
        gyokerPane.add(outputAblak, 0, 2, 6, 4);

        gyokerPane.setPadding(new Insets(20, 20, 20, 20));
        gyokerPane.setVgap(30);
        gyokerPane.setHgap(30);
        gyokerPane.setAlignment(Pos.BASELINE_LEFT);
        Scene scene = new Scene(gyokerPane, 900, 300);
        stage.setTitle("Angyalka");
        stage.setScene(scene);
        stage.show();

        // 10.feladat b.)
        Label hibaUzenetLabel = new Label("Negatív számot nem adhat meg!");
        hibaUzenetLabel.setTextFill(Color.RED);
        hozzaadButton.setOnAction(new EventHandler<ActionEvent>() {
            public void handle(ActionEvent event) {

                int elkeszitettInputValue = Integer.parseInt(elkeszitettTextField.textProperty().getValue());
                int eladottInputValue = Integer.parseInt(eladottTextField.textProperty().getValue());

                // i.)
                if ((elkeszitettInputValue < 0) || (eladottInputValue < 0)) {
                    gyokerPane.add(hibaUzenetLabel, 3, 1, 3, 1);
                    return;
                } else {
                    gyokerPane.getChildren().remove(hibaUzenetLabel);
                }

                // ii.)
                int kivalasztottNap = Integer.parseInt(napSzamaComboBox.getSelectionModel().getSelectedItem().toString());

                if(keszletDarabszam + elkeszitettInputValue < eladottInputValue){
                    hibaUzenetLabel.setText("Túl sok az eladott angyalka!");
                    gyokerPane.add(hibaUzenetLabel, 3, 1, 3, 1);
                    return;
                } else {
                    gyokerPane.getChildren().remove(hibaUzenetLabel);
                }

                // c.)
                keszletDarabszam += elkeszitettInputValue - eladottInputValue;
                outputAblak.appendText(kivalasztottNap + ".nap:     +" + elkeszitettInputValue + "     -" + eladottInputValue + "     =     " + keszletDarabszam);
                outputAblak.appendText("\n");
                elkeszitettTextField.textProperty().setValue("0");
                eladottTextField.textProperty().setValue("0");
                napSzamaComboBox.getItems().clear();
                for (int i = kivalasztottNap; i < 40; i++) {
                    napSzamaComboBox.getItems().addAll(i + 1);
                }
            }
        });
    }
}
