export interface Band {
  id?: number
  name: string;
  origin: string;
  city: string;
  startYear: number;
  endYear?: number;
  foundingMembers?: string;
  membersCount?: number;
  trend?: string;
  summary: string;
}
