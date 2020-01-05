defmodule Coyote.Accounts.User do
  use Ecto.Schema
  import Ecto.Changeset

  @cast_members [
    :email,
    :password,
    :password_confirmation,
    :receives_email,
    :last_name,
    :first_name,
    :address,
    :phone,
    :grad_year,
    :roll_number,
    :employer,
    :latitude,
    :longitude,
    :lifetime_member,
    :deceased
  ]

  schema "users" do
    field :email, :string
    field :password, :string, virtual: true
    field :password_confirmation, :string, virtual: true
    field :password_hash, :string
    field :email_verified_at, :utc_datetime
    field :receives_email, :boolean
    field :first_name, :string
    field :last_name, :string
    field :address, :string
    field :phone, :string
    field :grad_year, :integer
    field :roll_number, :integer
    field :employer, :string
    field :latitude, :decimal
    field :longitude, :decimal
    field :lifetime_member, :boolean
    field :deceased, :utc_datetime

    timestamps()
  end

  @doc false
  def create(user, attrs) do
    user
    |> cast(attrs, @cast_members)
    |> validate_required([
      :email,
      :password,
      :password_confirmation,
      :receives_email,
      :last_name,
      :first_name
    ])
    |> validate_common
  end

  @doc false
  def update(user, attrs) do
    user
    |> cast(attrs, @cast_members)
    |> validate_common
  end

  defp downcase_email(changeset) do
    update_change(changeset, :email, &String.downcase/1)
  end

  defp put_password_hash(
         %Ecto.Changeset{valid?: true, changes: %{password: password}} = changeset
       ) do
    change(changeset, Bcrypt.add_hash(password))
  end

  defp put_password_hash(changeset), do: changeset

  defp validate_common(changeset) do
    changeset
    |> validate_confirmation(:password)
    |> put_change(:password_confirmation, nil)
    |> put_password_hash
    |> downcase_email
    |> validate_length(:email, min: 5, max: 255)
    |> validate_date_type(:email_verified_at)
    |> validate_inclusion(:receives_email, [true, false])
    |> validate_length(:last_name, max: 255)
    |> validate_length(:first_name, max: 255)
    |> validate_length(:address, max: 255)
    |> validate_length(:phone, max: 15)
    |> validate_number(:grad_year, greater_than: 1950)
    |> validate_number(:roll_number, greater_than: 0)
    |> validate_length(:employer, max: 255)
    |> validate_number(:latitude, greater_than_or_equal_to: -90)
    |> validate_number(:latitude, less_than_or_equal_to: 90)
    |> validate_number(:longitude, greater_than_or_equal_to: -180)
    |> validate_number(:longitude, less_than_or_equal_to: 180)
    |> validate_location
    |> validate_inclusion(:lifetime_member, [true, false])
    |> validate_date_type(:deceased)
    |> unique_constraint(:email)
  end

  defp validate_date_type(%{changes: changes} = changeset, field) do
    if date = changes[field] do
      case DateTime.from_iso8601(date) do
        {:ok, _, _} -> changeset
        {:error, :invalid_format} -> add_error(changeset, field, "is not a valid date")
      end
    else
      changeset
    end
  end

  defp validate_location(
         %Ecto.Changeset{
           valid?: true,
           changes: %{address: address, latitude: %Decimal{}, longitude: %Decimal{}}
         } = changeset
       ) do
    if String.length(address) > 0 do
      changeset
    else
      add_error(changeset, :address, "does not have a valid latitude or longitude")
    end
  end

  defp validate_location(changeset), do: changeset
end
