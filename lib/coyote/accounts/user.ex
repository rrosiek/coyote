defmodule Coyote.Accounts.User do
  use Ecto.Schema
  import Ecto.Changeset

  schema "users" do
    field :email, :string
    field :password_hash, :string
    field :email_verified_at, :utc_datetime
    field :receives_email, :boolean
    field :first_name, :string
    field :last_name, :string
    field :address1, :string
    field :address2, :string
    field :city, :string
    field :state, :string
    field :zip, :string
    field :phone, :string
    field :grad_year, :integer
    field :roll_number, :integer
    field :employer, :string
    field :latitude, :decimal
    field :longitude, :decimal
    field :lifetime_member, :boolean, null: false
    field :deceased, :utc_datetime

    timestamps()
  end

  @doc false
  def changeset(user, attrs) do
    user
    |> cast(attrs, [])
    |> validate_required([])
  end
end
