defmodule Coyote.Repo.Migrations.CreateNewsletters do
  use Ecto.Migration

  def change do
    create table(:newsletters) do
      add :name, :string

      timestamps()
    end

  end
end
