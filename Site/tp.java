/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 
package vue;
import javax.swing.*; 
import java.awt.*; 
import modele.*; 
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JPanel;
import java.awt.Graphics;
import java.awt.Image;
import java.awt.image.BufferedImage;

 
public class LabyGraphique extends JFrame 
{  
    private JPanel pan ; // panneau    
    private JButton boutons[][]; // matrice de boutons 
    
    
    public LabyGraphique ()  
{ // constructeur   
    setTitle ("Ma premiere fenetre");     
    setSize (300, 150);  

    // constructeur      
    setTitle ("Mon labyrinthe");     
    setSize (300, 150);      
    pan = new JPanel(); // instancier le panneau    
    getContentPane().add(pan); // ajouter le panneau dans la fenêtre
    
    
} 
    
       
   // Méthode qui affiche la grille du labyrinthe  
    public void affiche(Labyrinthe laby) {        
        
        pan.setLayout(new GridLayout(laby.getTailleY(), laby.getTailleX())); // mise en forme avec une grille       
        boutons = new JButton[laby.getTailleY()][]; // instancier les lignes de la matrice de boutons 
 
        for (int i = 0; i < laby.getTailleY(); i++)       
        boutons[i] = new JButton[laby.getTailleX()];// Pour chaque ligne de la matrice, instancier les boutons    
        // Ajouter les boutons dans le panneau   
        for (int i = 0; i < laby.getTailleY(); i++)
{             for (int j = 0; j < laby.getTailleX(); j++) {               
   

if (laby.getCase(i,j) instanceof CaseMur)
{ 
    
ImageIcon img = new ImageIcon("murresize.jpg");

JButton bouton = new JButton(img);


pan.add(bouton);

//setContentPane(pan);

setSize(200,100);


}


if (laby.getCase(i,j) instanceof CaseTrou)
{ 
boutons[i][j] = new JButton();

//essais avec le setters 

      
boutons[i][j].setText( "T" );

pan.add(boutons[i][j]);  //instancier chaque bouton


}
 

    }  


/*Avec la méthode getCase de Labyrinthe, récupérer chaque case et afficher dans chaque bouton 
un texte ou une image associée à la case, soit de type CaseMur soit de type CaseTrou. 

}
           
    JPanel b1 = new JPanel();
    b1.setLayout(new BoxLayout(b1, BoxLayout.LINE_AXIS));
    b1.add(new JButton("HAUT"));
    JPanel b2 = new JPanel();
    b2.setLayout(new BoxLayout(b2, BoxLayout.LINE_AXIS));
    b2.add(new JButton("GAUCHE"));
    b2.add(new JButton("DROITE"));
    JPanel b3 = new JPanel();
    b3.setLayout(new BoxLayout(b3, BoxLayout.LINE_AXIS));
    b3.add(new JButton("BAS"));
    
    panbut.setLayout(new BoxLayout(panbut, BoxLayout.PAGE_AXIS));
    panbut.add(b1);
    panbut.add(b2);
    panbut.add(b3);
    //panbut.setPreferredSize(new Dimension(500,500));
    
    panmenu.setLayout(new BoxLayout(panmenu, BoxLayout.PAGE_AXIS));
    panmenu.add(new JButton("Automatique"));
    panmenu.add(new JButton("Quitter"));
    //panmenu.setPreferredSize(new Dimension(100,100));
    panmenu.setBorder(BorderFactory.createEmptyBorder(0,10,10,10));
        
    pancont.setLayout(new BoxLayout(pancont, BoxLayout.LINE_AXIS));
    pancont.add(panbut);
    pancont.add(panmenu); 
        // rendre la fenetre visible   
this.setVisible(true);


    }            

    
    
    

} 

*/

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package vue;

import javax.swing.*;
import java.awt.*;
import modele.*;


import java.awt.event.ActionEvent;
import java.awt.event.ActionListener; 
import javax.swing.JLabel;
import javax.swing.JPanel;
import java.awt.BorderLayout;
/**
 *
 * @author Vivien
 */
public class LabyGraphique extends JFrame implements ActionListener {
    private JPanel pan ; // panneau pour labyrinth
    private JPanel panbut ; // panneau pour boutons mouvement
    private JPanel pancont ; // panneau pour boutons controle
    private JPanel panmenu ; // panneau pour boutons menu 
    private JPanel panf ; // panneau final affiché
    private JButton boutons[][]; // matrice de boutons
    //private JLabel boutons[][]; // matrice de boutons
    
      private JLabel label = new JLabel("");
    
    public LabyGraphique (){ // constructeur
    setTitle ("Mon labyrinthe");
    setSize (1300, 1200);
    pan = new JPanel(); // instancier le panneau
    panbut = new JPanel();
    //panbut.setSize(new Dimension(500,500));
    panf= new JPanel();
    pancont= new JPanel();
    panmenu = new JPanel();
    
    panf.setLayout(new BoxLayout(panf, BoxLayout.PAGE_AXIS));
    panf.add(pan);
    panf.add(pancont);
    
    getContentPane().add(panf); // ajouter le panneau dans la fenêtre
    setLocationRelativeTo(null);//met la fenetre au centre
    setContentPane(panf);
    setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    }
    // Méthode qui affiche la grille du labyrinthe
    public void affiche(Labyrinthe laby) {
    pan.setLayout(new GridLayout(laby.getTailleY(), laby.getTailleX())); // mise en forme avec une grille
    boutons = new JButton[laby.getTailleY()][]; // instancier les lignes de la matrice de boutons
    //boutons = new JLabel[laby.getTailleY()][]; // instancier les lignes de la matrice de boutons
    
    for (int i = 0; i < laby.getTailleY(); i++)
    boutons[i] = new JButton[laby.getTailleX()];// Pour chaque ligne de la matrice, instancier les boutons
    //boutons[i] = new JLabel[laby.getTailleX()];// Pour chaque ligne de la matrice, instancier les boutons
    
    // Ajouter les boutons dans le panneau
    for (int i = 0; i < laby.getTailleY(); i++) {
        for (int j = 0; j < laby.getTailleX(); j++) {
            if (laby.getCase(i,j) instanceof CaseMur)
            {
             
               ImageIcon img= new ImageIcon(new ImageIcon("mur.jpg").getImage().getScaledInstance(300, 170, Image.SCALE_DEFAULT));
               JButton bouton = new JButton(img);
                pan.add(bouton);
                bouton.addActionListener(this);
                
              //setContentPane(pan);
            }
            if (laby.getCase(i,j) instanceof CaseTrou)
            { 
          ImageIcon img= new ImageIcon(new ImageIcon("terre_sol.jpg").getImage().getScaledInstance(300, 170, Image.SCALE_DEFAULT));
              JButton bouton = new JButton(img);
                
                
                pan.add(bouton);
             // setContentPane(pan);
            bouton.addActionListener(this);
        }
            
            
          Font police = new Font("Tahoma", Font.BOLD, 16);  
    label.setFont(police);  
    label.setForeground(Color.blue);  
    label.setHorizontalAlignment(JLabel.RIGHT);
    pan.add(label, BorderLayout.SOUTH);
    this.setContentPane(pan); 

    }
    
    JPanel b1 = new JPanel();
    b1.setLayout(new BoxLayout(b1, BoxLayout.LINE_AXIS));
    b1.add(new JButton("HAUT"));
    JPanel b2 = new JPanel();
    b2.setLayout(new BoxLayout(b2, BoxLayout.LINE_AXIS));
    b2.add(new JButton("GAUCHE"));
    b2.add(new JButton("DROITE"));
    JPanel b3 = new JPanel();
    b3.setLayout(new BoxLayout(b3, BoxLayout.LINE_AXIS));
    b3.add(new JButton("BAS"));
    
    panbut.setLayout(new BoxLayout(panbut, BoxLayout.PAGE_AXIS));
    panbut.add(b1);
    panbut.add(b2);
    panbut.add(b3);
    //panbut.setPreferredSize(new Dimension(500,500));
    
    panmenu.setLayout(new BoxLayout(panmenu, BoxLayout.PAGE_AXIS));
    panmenu.add(new JButton("Automatique"));
    panmenu.add(new JButton("Quitter"));
    //panmenu.setPreferredSize(new Dimension(100,100));
    panmenu.setBorder(BorderFactory.createEmptyBorder(0,500,10,10));
        
    pancont.setLayout(new BoxLayout(pancont, BoxLayout.LINE_AXIS));
    pancont.add(panbut);
    pancont.add(panmenu);
    
    
   
    // rendre la fenetre visible
    
    this.setVisible(true);
}
}


public void actionPerformed(ActionEvent e)
{ label.setText("Vous avez cliqué");
}
        
}


 

      

