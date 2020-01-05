defmodule Coyote.Repo.Migrations.CreateUsers do
  use Ecto.Migration

  def change do
    create table(:users) do
      add :role_id, references(:roles, on_delete: :nothing)
      add :email, :string, null: false
      add :password_hash, :string, null: false
      add :email_verified_at, :utc_datetime
      add :receives_email, :boolean, null: false
      add :first_name, :string, null: false
      add :last_name, :string, null: false
      add :address, :string
      add :phone, :string
      add :grad_year, :integer
      add :roll_number, :integer
      add :employer, :string
      add :latitude, :decimal
      add :longitude, :decimal
      add :lifetime_member, :boolean, null: false
      add :deceased, :utc_datetime

      timestamps()
    end
  end
end
