import Ecole from "./ecole.modelt";

export default interface Classe {
  id: number;
  ecole: Ecole;
  nameCl: string;
  niveauCl: string;
  anneeCl: Date;
}
