defmodule Coyote.Repo.Migrations.CreatePayments do
  use Ecto.Migration

  def change do
    create table(:payments) do
      add :email, :string
      add :name, :string
      add :zip, :string
      add :product, :string
      add :amount, :integer
      add :cc_brand, :string
      add :cc_lastfour, :string
      add :token, :string

      timestamps()
    end
  end
end
