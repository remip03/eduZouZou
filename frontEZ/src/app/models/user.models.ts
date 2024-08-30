import Ecole from "./ecole.modelt";

export default interface User {
  id: number;
  ecole: Ecole;
  email: string;
  roles: string;
  password: string;
  firstName: string;
  lastName: string;
  tel: number;
  adresse: string;
}
