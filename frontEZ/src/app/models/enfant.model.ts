import Classe from "./classe.model";

export default interface Enfant {
  id: number;
  classe: Classe;
  lastNameE: string;
  firstNameE: string;
  birthDateE: Date;
}
