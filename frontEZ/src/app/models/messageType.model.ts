export interface MessageType {
  id: number;
  content: string;
  destinataire: string;
  expediteur: string;
  msgDate: Date;
  isVisible: boolean;
}
