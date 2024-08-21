// export default interface Message {
//   id: number;
//   content: string;
//   destinataire: string;
//   expediteur: string;
//   msgDate: string;
// }

export default class Message {
  id!: number;
  content!: string;
  destinataire!: string;
  expediteur!: string;
  msgDate!: Date;
}
